<?php

namespace App\Http\Controllers\Admin\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Managements\Role\RoleRequest;
use App\Http\Request\Admin\Managements\Role\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Admin;
use App\models\Role;
use App\models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class RoleController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-roles')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.managements.roles.data'),
                'header'  => [
                    'admin.global.name',
                    'admin.global.admin',
                    'menu.admins',
                ],
                'columns' => [
                    'name'    => 'name',
                    'admin'   => 'admin',
                    'admins'  => 'admins',
                ]
            ]
        );

        return view('admin.managements.roles.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-roles',
            'update' => 'update-roles',
            'delete' => 'delete-roles',
        ];

        $role = Role::roleNot();

        return dataTables()->of($role)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Role $role) => $role?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Role $role) => $role?->admin?->name)
            ->addColumn('admins', fn (Role $role) => Admin::role($role->name)->count())
            ->addColumn('admins_count', fn (Role $role) => $role?->admins?->count())
            ->addColumn('actions', function(Role $role) use($permissions) {
                $routeEdit   = route('admin.managements.roles.edit', $role->id);
                $routeDelete = route('admin.managements.roles.destroy', $role->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->rawColumns(['record_select', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-roles')) {
            return abort(403);
        }

        $permissions = Permission::pluck('name', 'name');

        return view('admin.managements.roles.create', compact('permissions'));
        
    }//end of create

    //RedirectResponse
    public function store(RoleRequest $request): RedirectResponse
    {
        $validated = request()->except(['permissions']);

        $role = \Spatie\Permission\Models\Role::create($validated);
        $role->syncPermissions($request->permissions ?? []);

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.managements.roles.index');

    }//end of store

    public function edit(\Spatie\Permission\Models\Role $role): View
    {
        if(!permissionAdmin('update-roles')) {
            return abort(403);
        }
        
        $permissions = Permission::pluck('name', 'name');

        return view('admin.managements.roles.edit', compact('role', 'permissions'));

    }//end of edit

    public function update(RoleRequest $request, \Spatie\Permission\Models\Role $role): RedirectResponse
    {
        $validated = request()->except(['permissions']);

        $role->update($validated);
        $role->syncPermissions($request->permissions ?? []);

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.managements.roles.index');
        
    }//end of update

    public function destroy(Role $role): Application | Response | ResponseFactory
    {
        if(!$role->default) {

            $role->flag ? Storage::disk('public')->delete($role->flag) : '';
            $role->delete();
        }

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        $images = Role::where('default', 0)->find(request()->ids ?? [])->pluck('flag')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Role::where('default', 0)->destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

}//end of controller