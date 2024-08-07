<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Enums\Admin\RatingCard;
use App\Models\Card;
use App\Models\Category;
use App\Http\Request\Admin\Products\Card\CardRequest;
use App\Http\Request\Admin\Products\Card\StatusRequest;
use App\Http\Request\Admin\Products\Card\DeleteRequest;
use App\Services\DatatableServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Collection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CardController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-cards')) {
            return abort(403);
        }
        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.cards.data'),
                'checkbox' => [
                    'status' => route('admin.products.cards.status'),
                ],
                'header'  => [
                    'menu.sub_categories',
                    'menu.markets',
                    'admin.products.cards.rating',
                    'admin.global.price',
                    'admin.global.admin',
                    'admin.global.status',
                ],
                'columns' => [
                    'sub_category' => 'sub_category',
                    'market'       => 'market',
                    'rating'       => 'rating',
                    'price'        => 'price',
                    'admin'        => 'admin',
                    'status'       => 'status',
                ]
            ]
        );

        return view('admin.products.cards.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-cards'),
            'update' => permissionAdmin('update-cards'),
            'delete' => permissionAdmin('delete-cards'),
        ];

        $card = Card::query();

        return dataTables()->of($card)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Card $card) => $card->created_at->format('Y-m-d'))
            ->addColumn('admin', fn(Card $card) => $card?->admin?->name)
            ->addColumn('sub_category', fn(Card $card) => $card?->subCategory?->name)
            ->addColumn('market', fn(Card $card) => $card?->market?->name)
            ->addColumn('actions', function(Card $card) use($permissions) {
                $routeEdit   = route('admin.products.cards.edit', $card->id);
                $routeDelete = route('admin.products.cards.destroy', $card->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Card $card) use($permissions) {
                return view('admin.dataTables.checkbox', ['models' => $card, 'permissions' => $permissions, 'type' => 'status']);
            })
            ->addColumn('name', fn(Card $card) => $card->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-cards')) {
            return abort(403);
        }

        $categories         = Category::category()->pluck('name', 'id');
        $subcategory        = old('category_id') ? Category::subcategory()->where('parent_id', old('category_id'))->pluck('name', 'id') : [];
        $subCategoryMarkets = collect(Category::subCategory()->with('markets')->get())->groupBy('id');
        $ratings            = RatingCard::array();

        return view('admin.products.cards.create', compact('categories', 'ratings', 'subcategory', 'subCategoryMarkets'));

    }//end of create

    public function store(CardRequest $request): RedirectResponse
    {
        $requestData = request()->except('category_id', 'sub_category');
        $requestData['category_id'] = request()->sub_category;
        Card::create($requestData);

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.products.cards.index');

    }//end of store

    public function edit(Card $card): View
    {
        if(!permissionAdmin('update-cards')) {
            return abort(403);
        }

        $categories         = Category::category()->pluck('name', 'id');
        $subcategory        = old('category_id', $card->subCategory->parent_id) ? Category::subcategory()->where('parent_id', old('category_id', $card->subCategory->parent_id))->pluck('name', 'id') : [];
        $subCategoryMarkets = collect(Category::subCategory()->with('markets')->get())->groupBy('id');
        $ratings            = RatingCard::array();

        return view('admin.products.cards.edit', compact('card', 'categories', 'ratings', 'subcategory', 'subCategoryMarkets'));

    }//end of edit

    public function update(CardRequest $request, Card $card): RedirectResponse
    {
        $requestData = request()->except('category_id', 'sub_category', 'slug');
        $requestData['category_id'] = request()->sub_category;
        $card->update($requestData);

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.products.cards.index');

    }//end of update

    public function destroy(Card $card): Application | Response | ResponseFactory
    {
        $card->delete();

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        Card::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $card = Card::find($request->id);
        $card->update(['status' => !$card->status]);

        session()->flash('success', __('admin.global.updated_successfully'));
        return response(__('admin.global.updated_successfully'));

    }//end of status

    public function category(Category $category): Application | Response | ResponseFactory
    {
        return response($category->subCategoriesRelation()->pluck('name', 'id')->toArray());

    }//end of get sub category

    public function markets(Category $subCategory): Application | Response | ResponseFactory
    {
        return response([
            'items'     => $subCategory->markets->pluck('name', 'id')->toArray(),
            'has_market'=> (bool) $subCategory->has_market,
            'color1'    => $subCategory->color_1,
            'color2'    => $subCategory->color_2,
            'titleCard' => $subCategory->title_card,
        ]);

    }//end of get markets from sub category

}//end of controller