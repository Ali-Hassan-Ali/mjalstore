<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Category\CategoryRequest;
use App\Http\Request\Admin\Category\StatusRequest;
use App\Http\Request\Admin\Category\DeleteRequest;
use App\models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        $datatableColumns = [
            'admin'      => 'admin',
            'name'       => 'name',
            'status'     => 'status',
        ];
dd('fdf');
        return view('admin.languages.index', compact('datatableColumns'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => 'status-admin',
            'edit'   => 'edit-admin',
            'delete' => 'delete-admin',
        ];

        $category   = Category::status();

        return dataTables()->of($category)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Category $category) => $category->created_at->format('Y-m-d'))
            ->addColumn('admin', fn (Category $category) => $category->admin->name)
            ->addColumn('actions', function(Category $category) use($permissions) {
                $models      = $category;
                $routeEdit   = route('admin.languages.edit', $category->id);
                $routeDelete = route('admin.languages.edit', $category->id);
                return view('admin.dataTables.actions', compact('models', 'permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Category $category) use($permissions) {
                $models = $category;
                return view('admin.dataTables.status', compact('models', 'permissions'));
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create()
    {
        return view('admin.languages.create');
        
    }//end of create

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.languages.index');

    }//end of store

    public function edit(Category $category)
    {
        return view('admin.languages.create', compact('category'));

    }//end of edit

    public function update(CategoryRequest $request, Category $category)
    {$category->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.languages.index');
        
    }//end of update

    public function delete()
    {
        
    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        Category::destroy(json_decode(request()->record_ids));

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
        
    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        Category::update(['status' => !$request->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller