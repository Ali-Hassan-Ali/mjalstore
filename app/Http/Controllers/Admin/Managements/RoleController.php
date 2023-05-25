<?php

namespace App\Http\Controllers\Admin\Managements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Managements\Role\RoleRequest;
use App\Http\Request\Admin\Managements\Role\StatusRequest;
use App\Http\Request\Admin\Managements\Role\DeleteRequest;
use App\Enums\Admin\RoleType;
use App\Services\DatatableServices;
use App\models\Role;
use Illuminate\Support\Facades\Storage;
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
                'route_status' => route('admin.managements.roles.status'),
                'header'  => [
                    'site.name',
                    'site.admin',
                    'site.admins_count',
                ],
                'columns' => [
                    'name'         => 'name',
                    'admin'        => 'admin',
                    'admins_count' => 'admins_count',
                ]
            ]
        );

        return view('admin.managements.roles.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => 'status-roles',
            'update' => 'update-roles',
            'delete' => 'delete-roles',
        ];

        $role   = Role::all();

        return dataTables()->of($role)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Role $role) => $role?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Role $role) => $role?->admin?->name)
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
        $permissions = Permission::pluck('name', 'name');

        return view('admin.managements.roles.create', compact('permissions'));
        
    }//end of create

    //RedirectResponse
    public function store(RoleRequest $request): RedirectResponse
    {
        $validated = request()->safe()->except(['permissions']);

        $role = Role::create($validated);
        $role->syncPermissions(request()->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.managements.roles.index');

    }//end of store

    public function edit(Role $role): View
    {
        $types = RoleType::pluck('name', 'name');

        return view('admin.managements.roles.edit', compact('language', 'types'));

    }//end of edit

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $requestData = request()->except('flag');

        if(request()->has('flag')) {

            $role->flag ? Storage::disk('public')->delete($role->flag) : '';

            $requestData['flag'] = request()->file('flag')->store('roles', 'public');

        }

        $role->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.managements.roles.index');
        
    }//end of update

    public function destroy(Role $role): Application | Response | ResponseFactory
    {
        if(!$role->default) {

            $role->flag ? Storage::disk('public')->delete($role->flag) : '';
            $role->delete();
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Role::where('default', 0)->find(request()->ids ?? [])->pluck('flag')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Role::where('default', 0)->destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $role = Role::find($request->id);
        $role?->update(['status' => !$role->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

    public function changeDefault(StatusRequest $request)
    {
        $roles = Role::all();
        $roles->each(fn ($role) => $role->update(['default' => 0]));
        Role::find($request->id)->update(['default' => 1, 'status' => 1]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller