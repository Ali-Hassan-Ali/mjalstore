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
                'route' => route('admin.sub_categories.data'),
                'route_status' => route('admin.sub_categories.status'),
                'header'  => [
                    'site.name',
                    'site.banner',
                    'site.admin',
                    'site.status',
                    'site.has_market',
                ],
                'columns' => [
                    'name'       => 'name',
                    'banner'     => 'banner',
                    'admin'      => 'admin',
                    'status'     => 'status',
                    'has_market' => 'has_market',
                ]
            ]
        );

        return view('admin.sub_categories.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => permissionAdmin('status-sub_categories'),
            'update' => permissionAdmin('update-sub_categories'),
            'delete' => permissionAdmin('delete-sub_categories'),
        ];
        
        $category = Category::subCategory();

        return dataTables()->of($category)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Category $category) => $category->created_at->format('Y-m-d'))
            ->addColumn('admin', fn(Category $category) => $category?->admin?->name)
            ->editColumn('banner', function(Category $category) {
                return view('admin.dataTables.image', ['models' => $category]);
            })
            ->addColumn('actions', function(Category $category) use($permissions) {
                $routeEdit   = route('admin.sub_categories.edit', $category->id);
                $routeDelete = route('admin.sub_categories.destroy', $category->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Category $category) use($permissions) {
                return view('admin.dataTables.status', ['models' => $category, 'permissions' => $permissions]);
            })
            ->addColumn('has_market', function(Category $category) use($permissions) {
                return view('admin.dataTables.status', ['models' => $category, 'permissions' => $permissions]);
            })
            ->addColumn('name', fn(Category $category) => $category->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status', 'has_market', 'name', 'logo'])
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

        session()->flash('success', __('site.added_successfully'));
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
        $requestData = request()->except('banner');
        if(request()->file('banner')) {

            Storage::disk('public')->delete($category->banner);

            $requestData['banner'] = request()->file('banner')->store('sub_categories', 'public');

        }
        $subCategory->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.sub_categories.index');

    }//end of update

    public function destroy(Category $subCategory): Application | Response | ResponseFactory
    {
        if($category->logo) {
            Storage::disk('public')->delete($category->logo);
        }
        $category->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Category::find(request()->ids ?? [])->pluck('logo')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Category::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $slider = Category::find($request->id);
        $slider->update(['status' => !$slider->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));

    }//end of status

}//end of controller
