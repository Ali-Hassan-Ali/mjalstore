<?php

namespace App\Http\Controllers\Admin\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Managements\Admin\AdminRequest;
use App\Http\Request\Admin\Managements\Admin\StatusRequest;
use App\Http\Request\Admin\Managements\Admin\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Admin;
use App\Models\Rol;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-admins')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.managements.admins.data'),
                'route_status' => route('admin.managements.admins.status'),
                'header'  => [
                    'site.name',
                    'site.email',
                    'site.image',
                    'site.roles',
                    'site.admin',
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'email'  => 'email',
                    'image'  => 'image',
                    'roles'  => 'roles',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.managements.admins.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => 'status-admins',
            'update' => 'update-admins',
            'delete' => 'delete-admins',
        ];

        $admin = Admin::all();

        return dataTables()->of($admin)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Admin $admin) => $admin?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Admin $admin) => $admin?->admin?->name)
            ->addColumn('roles', fn (Admin $admin) => $admin?->admin?->name)
            ->editColumn('image', function(Admin $admin) {
                return view('admin.dataTables.image', ['models' => $admin]);
            })
            ->addColumn('actions', function(Admin $admin) use($permissions) {
                $routeEdit   = route('admin.managements.admins.edit', $admin->id);
                $routeDelete = '';
                if(!$admin->default) {
                    $routeDelete = route('admin.managements.admins.destroy', $admin->id);
                }
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Admin $admin) use($permissions) {
                if(!$admin->default) {
                    return view('admin.dataTables.status', ['models' => $admin, 'permissions' => $permissions]);
                }
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        $roles = Rol::whereNotIn('name', ['super_admin'])->get();

        return view('admin.managements.admins.create', compact('roles'));
        
    }//end of create

    //RedirectResponse
    public function store(AdminRequest $request): RedirectResponse
    {
        $requestData = request()->except('image');

        if(request()->file('image')) {

            $requestData['image'] = request()->file('image')->store('languages', 'public');

        }

        Admin::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.managements.admins.index');

    }//end of store

    public function edit(Admin $admin): View
    {
        $roles = Role::all();

        return view('admin.managements.admins.edit', compact('language', 'roles'));

    }//end of edit

    public function update(AdminRequest $request, Admin $admin): RedirectResponse
    {
        $requestData = request()->except('image');

        if(request()->has('image')) {

            $admin->image ? Storage::disk('public')->delete($admin->image) : '';

            $requestData['image'] = request()->file('image')->store('languages', 'public');

        }

        $admin->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.managements.admins.index');
        
    }//end of update

    public function destroy(Admin $admin): Application | Response | ResponseFactory
    {
        if(!$admin->default) {

            $admin->image ? Storage::disk('public')->delete($admin->image) : '';
            $admin->delete();
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Admin::where('default', 0)->find(request()->ids ?? [])->pluck('image')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Admin::where('default', 0)->destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $admin = Admin::find($request->id);
        $admin->update(['status' => !$admin->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller