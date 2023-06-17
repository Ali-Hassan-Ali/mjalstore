<?php

namespace App\Http\Controllers\Admin\Footers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Footers\Page\PageRequest;
use App\Http\Request\Admin\Footers\Page\StatusRequest;
use App\Http\Request\Admin\Footers\Page\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class PageController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-pages')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.footers.pages.data'),
                'route_status' => route('admin.footers.pages.status'),
                'header'  => [
                    'admin.global.title',
                    'admin.global.description',
                    'admin.global.admin',
                    'admin.global.status',
                ],
                'columns' => [
                    'title'   => 'title',
                    'description'  => 'description',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.footers.pages.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-pages',
            'update' => 'update-pages',
            'delete' => 'delete-pages',
        ];

        $page = Page::query();

        return dataTables()->of($page)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Page $page) => $page?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Page $page) => $page?->admin?->name)
            ->addColumn('title', fn (Page $page) => $page?->title)
            ->addColumn('description', fn (Page $page) => str()->limit($page?->description_one, 60))
            ->addColumn('actions', function(Page $page) use($permissions) {
                $routeEdit   = route('admin.footers.pages.edit', $page->id);
                $routeDelete = route('admin.footers.pages.destroy', $page->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Page $page) use($permissions) {
                return view('admin.dataTables.status', ['models' => $page, 'permissions' => $permissions]);
            })
            ->rawColumns(['record_select', 'actions', 'status', 'description'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-pages')) {
            return abort(403);
        }

        return view('admin.footers.pages.create');
        
    }//end of create

    //RedirectResponse
    public function store(PageRequest $request): RedirectResponse
    {
        Page::create(request()->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.footers.pages.index');

    }//end of store

    public function edit(Page $page): View
    {
        if(!permissionAdmin('update-pages')) {
            return abort(403);
        }

        return view('admin.footers.pages.edit', compact('page'));

    }//end of edit

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $page->update(request()->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.footers.pages.index');
        
    }//end of update

    public function destroy(Page $page): Application | Response | ResponseFactory
    {
        $page->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        Page::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $page = Page::find($request->id);
        $page->update(['status' => !$page->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller