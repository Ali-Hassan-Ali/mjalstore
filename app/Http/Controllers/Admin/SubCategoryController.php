<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Request\Admin\SubCategory\SubCategoryRequest;
use App\Http\Request\Admin\SubCategory\StatusRequest;
use App\Http\Request\Admin\SubCategory\DeleteRequest;
use App\Services\DatatableServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class SubCategoryController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-sub_categories')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route'    => route('admin.sub_categories.data'),
                'checkbox' => [
                    'status'     => route('admin.sub_categories.status'),
                    'has_market' => route('admin.sub_categories.has_market'),
                ],
                'header'  => [
                    'admin.global.name',
                    'menu.categories',
                    'admin.sub_category.banner',
                    'admin.global.admin',
                    'admin.global.status',
                    'admin.sub_category.has_market',
                ],
                'columns' => [
                    'name'       => 'name',
                    'category'   => 'category',
                    'banner'     => 'banner',
                    'admin'      => 'admin',
                    'status'     => 'status',
                    'has_market' => 'has_market',
                ]
            ]
        );

        return view('admin.sub_categories.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-sub_categories'),
            'update' => permissionAdmin('update-sub_categories'),
            'delete' => permissionAdmin('delete-sub_categories'),
        ];
        
        $subCategory = Category::subCategory();

        return dataTables()->of($subCategory)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Category $subCategory) => $subCategory->created_at->format('Y-m-d'))
            ->addColumn('admin', fn(Category $subCategory) => $subCategory?->admin?->name)
            ->addColumn('category', fn(Category $subCategory) => $subCategory?->categoryRelation?->name)
            ->editColumn('banner', function(Category $subCategory) {
                return view('admin.dataTables.image', ['models' => $subCategory]);
            })
            ->addColumn('actions', function(Category $subCategory) use($permissions) {
                $routeEdit   = route('admin.sub_categories.edit', $subCategory->id);
                $routeDelete = route('admin.sub_categories.destroy', $subCategory->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Category $subCategory) use($permissions) {
                return view('admin.dataTables.checkbox', ['models' => $subCategory, 'permissions' => $permissions, 'type' => 'status']);
            })
            ->addColumn('has_market', function(Category $subCategory) use($permissions) {
                if (!$subCategory->cards->count()) {
                    return view('admin.dataTables.checkbox', ['models' => $subCategory, 'permissions' => $permissions, 'type' => 'has_market']);
                }
            })
            ->addColumn('name', fn(Category $subCategory) => $subCategory->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status', 'has_market', 'name', 'banner'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-sub_categories')) {
            return abort(403);
        }

        $categories = Category::category()->pluck('name', 'id');

        return view('admin.sub_categories.create', compact('categories'));

    }//end of create

    public function store(SubCategoryRequest $request): RedirectResponse
    {
        $requestData = request()->except('banner');

        if(request()->file('banner')) {

            $requestData['banner'] = request()->file('banner')->store('sub_categories', 'public');

        }

        Category::create($requestData);

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.sub_categories.index');

    }//end of store

    public function edit(Category $subCategory): View
    {
        if(!permissionAdmin('update-sub_categories')) {
            return abort(403);
        }

        $categories = Category::category()->pluck('name', 'id');

        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));

    }//end of edit

    public function update(SubCategoryRequest $request, Category $subCategory): RedirectResponse
    {
        $requestData = request()->except('banner', 'has_market');

        if(request()->file('banner')) {

            $subCategory->banner ? Storage::disk('public')->delete($subCategory->banner) : '';

            $requestData['banner'] = request()->file('banner')->store('sub_categories', 'public');

        }

        $requestData['has_market'] = $subCategory->cards->count() ? $subCategory->has_market : request()->has_market;

        $subCategory->update($requestData);

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.sub_categories.index');

    }//end of update

    public function destroy(Category $subCategory): Application | Response | ResponseFactory
    {
        $subCategory->banner ? Storage::disk('public')->delete($subCategory->banner) : '';
        $subCategory->cards()?->delete();
        $subCategory->markets()?->delete();
        $subCategory->delete();

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Response | ResponseFactory
    {
        $images = Category::subCategory()->find(request()->ids ?? [])->whereNotNull('banner')->pluck('banner')->toArray();
        count($images) ? Storage::disk('public')->delete($images) : '';
        Category::subCategory()->with('cards', 'markets')->find(request()->ids ?? [])?->each(fn ($subCategory) => [$subCategory->cards()?->delete(), $subCategory->markets()?->delete()]);
        Category::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $subCategory = Category::subCategory()->find($request->id);
        $subCategory->update(['status' => !$subCategory->status]);

        session()->flash('success', __('admin.global.updated_successfully'));
        return response(__('admin.global.updated_successfully'));

    }//end of status

    public function hasMarket(StatusRequest $request): Application | Response | ResponseFactory
    {
        $subCategory = Category::subCategory()->find($request->id);

        if (!$subCategory->cards->count()) {
            $subCategory->update(['has_market' => !$subCategory->has_market]);
        }

        session()->flash('success', __('admin.global.updated_successfully'));
        return response(__('admin.global.updated_successfully'));

    }//end of status

}//end of controller