<?php

namespace App\Http\Controllers\Admin\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Managements\Admin\AdminRequest;
use App\Http\Request\Admin\Managements\Admin\StatusRequest;
use App\Http\Request\Admin\Managements\Admin\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Admin;
use App\Models\Role;
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
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'email'  => 'email',
                    'image'  => 'image',
                    'roles'  => 'roles',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.managements.admins.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-admins',
            'update' => 'update-admins',
            'delete' => 'delete-admins',
        ];

        $admin = Admin::roleNot(['super_admin']);

        return dataTables()->of($admin)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Admin $admin) => $admin?->created_at?->format('Y-m-d'))
            ->editColumn('image', function(Admin $admin) {
                return view('admin.dataTables.image', ['models' => $admin]);
            })
            ->addColumn('roles', function(Admin $admin) {
                return view('admin.managements.admins.data_tables.roles', compact('admin'));
            })
            ->addColumn('actions', function(Admin $admin) use($permissions) {
                $routeEdit   = route('admin.managements.admins.edit', $admin->id);
                $routeDelete = route('admin.managements.admins.destroy', $admin->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Admin $admin) use($permissions) {
                if(!$admin->default) {
                    return view('admin.dataTables.status', ['models' => $admin, 'permissions' => $permissions]);
                }
            })
            ->rawColumns(['record_select', 'actions', 'status', 'roles'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-admins')) {
            return abort(403);
        }

        $roles = Role::whereNotIn('name', ['super_admin'])->pluck('name', 'name');

        return view('admin.managements.admins.create', compact('roles'));
        
    }//end of create

    //RedirectResponse
    public function store(AdminRequest $request): RedirectResponse
    {
        $requestData = request()->except(['image', 'roles', 'password_confirmation']);

        if(request()->file('image')) {

            $requestData['image'] = request()->file('image')->store('languages', 'public');

        }


        $admin = Admin::create($requestData);

        if(request()->has('password')) {

            $admin->update(['password' => bcrypt(request()->password)]);
        }

        if(request()->has('roles')) {
            $admin->assignRole(request()->roles);
        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.managements.admins.index');

    }//end of store

    public function edit(Admin $admin): View
    {
        if(!permissionAdmin('update-admins')) {
            return abort(403);
        }
        
        $roles = Role::whereNotIn('name', ['super_admin'])->pluck('name', 'name');

        return view('admin.managements.admins.edit', compact('admin', 'roles'));

    }//end of edit

    public function update(AdminRequest $request, Admin $admin): RedirectResponse
    {
        $requestData = request()->except(['image', 'roles', 'password', 'password_confirmation']);

        if(request()->has('image')) {

            $admin->image ? Storage::disk('public')->delete($admin->image) : '';

            $requestData['image'] = request()->file('image')->store('admins', 'public');

        }

        $admin->update($requestData);

        if(request()->has('roles')) {

            $admin->assignRole(request()->roles);
        }

        if(request()->has('password')) {

            $admin->update(['password' => bcrypt(request()->password)]);
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.managements.admins.index');
        
    }//end of update

    public function destroy(Admin $admin): Application | Response | ResponseFactory
    {
        $admin->image ? Storage::disk('public')->delete($admin->image) : '';
        $admin->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        $images = Admin::where('default', 0)->find(request()->ids ?? [])->pluck('image')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Admin::where('default', 0)->destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $admin = Admin::find($request->id);
        $admin->update(['status' => !$admin->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller