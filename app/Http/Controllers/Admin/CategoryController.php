<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Request\Admin\Category\CategoryRequest;
use App\Http\Request\Admin\Category\StatusRequest;
use App\Http\Request\Admin\Category\DeleteRequest;
use App\Services\DatatableServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CategoryController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-categories')) {
            return abort(403);
        }
        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.categories.data'),
                'checkbox' => [
                    'status' => route('admin.categories.status'),
                ],
                'header'  => [
                    'admin.global.name',
                    'admin.global.logo',
                    'admin.global.admin',
                    'admin.global.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'logo'   => 'logo',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.categories.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-categories'),
            'update' => permissionAdmin('update-categories'),
            'delete' => permissionAdmin('delete-categories'),
        ];

        $category = Category::category();

        return dataTables()->of($category)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Category $category) => $category->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn(Category $category) => $category?->admin?->name)
            ->editColumn('logo', function(Category $category) {
                return view('admin.dataTables.image', ['models' => $category]);
            })
            ->addColumn('actions', function(Category $category) use($permissions) {
                $routeEdit   = route('admin.categories.edit', $category->id);
                $routeDelete = route('admin.categories.destroy', $category->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Category $category) use($permissions) {
                return view('admin.dataTables.checkbox', ['models' => $category, 'permissions' => $permissions, 'type' => 'status']);
            })
            ->addColumn('name', fn(Category $category) => $category->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status', 'name', 'logo'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-categories')) {
            return abort(403);
        }

        return view('admin.categories.create');

    }//end of create

    public function store(CategoryRequest $request): RedirectResponse
    {
        $requestData = request()->except('logo');

        if(request()->file('logo')) {

            $requestData['logo'] = request()->file('logo')->store('categories', 'public');

        }

        Category::create($requestData);

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.categories.index');

    }//end of store

    public function edit(Category $category): View
    {
        if(!permissionAdmin('update-categories')) {
            return abort(403);
        }

        return view('admin.categories.edit', compact('category'));

    }//end of edit

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $requestData = request()->except('logo');
        if(request()->file('logo')) {

            $category->logo ? Storage::disk('public')->delete($category->logo) : '';

            $requestData['logo'] = request()->file('logo')->store('categories', 'public');

        }
        $category->update($requestData);

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.categories.index');

    }//end of update

    public function destroy(Category $category): Application | Response | ResponseFactory
    {
        $category->logo ? Storage::disk('public')->delete($category->logo) : '';
        $category->subCategoriesRelation()?->each(fn ($subCategory) => 
                [
                    $subCategory->cards()?->delete(),
                    $subCategory->markets()?->delete(),
                    $subCategory->delete()
                ]);
        $category->delete();

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Category::find(request()->ids ?? [])->whereNotNull('logo')->pluck('logo')->toArray();
        count($images) > 0 ? Storage::disk('public')->delete($images) : '';
        Category::with('subCategoriesRelation.cards', 'subCategoriesRelation.markets')?->find(request()->ids ?? [])?->each(fn ($category) => 
            $category->subCategoriesRelation()?->each(fn ($subCategory) => 
                [
                    $subCategory->cards()?->delete(),
                    $subCategory->markets()?->delete(),
                    $subCategory->delete()
                ])
        );
        Category::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $slider = Category::find($request->id);
        $slider->update(['status' => !$slider->status]);

        session()->flash('success', __('admin.global.updated_successfully'));
        return response(__('admin.global.updated_successfully'));

    }//end of status

}//end of controller
