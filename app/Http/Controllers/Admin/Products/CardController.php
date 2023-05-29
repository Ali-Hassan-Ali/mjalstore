<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CardController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-markets')) {
            return abort(403);
        }
        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.markets.data'),
                'route_status' => route('admin.products.markets.status'),
                'header'  => [
                    'site.name',
                    'site.flag',
                    'site.admin',
                    'site.sub_category',
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'flag'   => 'flag',
                    'admin'  => 'admin',
                    'sub_category' => 'sub_category',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.products.markets.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => permissionAdmin('status-markets'),
            'update' => permissionAdmin('update-markets'),
            'delete' => permissionAdmin('delete-markets'),
        ];

        $card = Card::query();

        return dataTables()->of($card)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Card $card) => $card->created_at->format('Y-m-d'))
            ->addColumn('admin', fn(Card $card) => $card?->admin?->name)
            ->addColumn('sub_category', fn(Card $card) => $card?->subCategory?->name)
            ->editColumn('flag', function(Card $card) {
                return view('admin.dataTables.image', ['models' => $card]);
            })
            ->addColumn('actions', function(Card $card) use($permissions) {
                $routeEdit   = route('admin.products.markets.edit', $card->id);
                $routeDelete = route('admin.products.markets.destroy', $card->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Card $card) use($permissions) {
                return view('admin.dataTables.status', ['models' => $card, 'permissions' => $permissions]);
            })
            ->addColumn('name', fn(Card $card) => $card->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status', 'name', 'flag'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-markets')) {
            return abort(403);
        }

        $subCategories = Category::subCategory()->pluck('name', 'id');

        return view('admin.products.markets.create', compact('subCategories'));

    }//end of create

    public function store(CardRequest $request): RedirectResponse
    {
        Card::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.products.markets.index');

    }//end of store

    public function edit(Card $card): View
    {
        if(!permissionAdmin('update-markets')) {
            return abort(403);
        }

        $subCategories = Category::subCategory()->pluck('name', 'id');

        return view('admin.products.markets.edit', compact('market', 'subCategories'));

    }//end of edit

    public function update(CardRequest $request, Card $card): RedirectResponse
    {
        $requestData = request()->except('flag');
        if(request()->file('flag')) {

            Storage::disk('public')->delete($card->flag);

            $requestData['flag'] = request()->file('flag')->store('markets', 'public');

        }
        $card->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.products.markets.index');

    }//end of update

    public function destroy(Card $card): Application | Response | ResponseFactory
    {
        if($card->flag) {
            Storage::disk('public')->delete($card->flag);
        }
        $card->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Card::find(request()->ids ?? [])->pluck('flag')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Card::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $card = Card::find($request->id);
        $card->update(['status' => !$card->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));

    }//end of status

}//end of controller
