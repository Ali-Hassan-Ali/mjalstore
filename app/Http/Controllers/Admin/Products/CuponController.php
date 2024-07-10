<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Products\Cupon\CuponRequest;
use App\Http\Request\Admin\Products\Cupon\StatusRequest;
use App\Http\Request\Admin\Products\Cupon\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Cupon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CuponController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-cupons')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.cupons.data'),
                'checkbox' => [
                    'status' => route('admin.products.cupons.status'),
                ],
                'header'  => [
                    'admin.global.code',
                    'admin.products.cupons.start_date',
                    'admin.products.cupons.end_date',
                    'admin.global.price',
                    'admin.global.admin',
                    'admin.global.status',
                ],
                'columns' => [
                    'code'       => 'code',
                    'start_date' => 'start_date',
                    'end_date'   => 'end_date',
                    'price'      => 'price',
                    'admin'      => 'admin',
                    'status'     => 'status',
                ]
            ]
        );

        return view('admin.products.cupons.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-cupons',
            'update' => 'update-cupons',
            'delete' => 'delete-cupons',
        ];

        $cupon = Cupon::query();

        return dataTables()->of($cupon)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Cupon $cupon) => $cupon?->created_at?->format('Y-m-d'))
            ->addColumn('end_date', fn (Cupon $cupon) => $cupon?->end_date?->format('Y-m-d'))
            ->addColumn('start_date', fn (Cupon $cupon) => $cupon?->start_date?->format('Y-m-d'))
            ->addColumn('admin', fn (Cupon $cupon) => $cupon?->admin?->name)
            ->addColumn('actions', function(Cupon $cupon) use($permissions) {
                $routeEdit   = route('admin.products.cupons.edit', $cupon->id);
                $routeDelete = route('admin.products.cupons.destroy', $cupon->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Cupon $cupon) use($permissions) {
                return view('admin.dataTables.checkbox', ['models' => $cupon, 'permissions' => $permissions, 'type' => 'status']);
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-cupons')) {
            return abort(403);
        }

        return view('admin.products.cupons.create');
        
    }//end of create

    //RedirectResponse
    public function store(CuponRequest $request): RedirectResponse
    {
        Cupon::create(request()->all());

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.products.cupons.index');

    }//end of store

    public function edit(Cupon $cupon): View
    {
        if(!permissionAdmin('update-cupons')) {
            return abort(403);
        }

        return view('admin.products.cupons.edit', compact('cupon'));

    }//end of edit

    public function update(CuponRequest $request, Cupon $cupon): RedirectResponse
    {
        $cupon->update(request()->all());

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.products.cupons.index');
        
    }//end of update

    public function destroy(Cupon $cupon): Application | Response | ResponseFactory
    {
        $cupon->delete();

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        Cupon::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $cupon = Cupon::find($request->id);
        $cupon?->update(['status' => !$cupon->status]);

        session()->flash('success', __('admin.global.updated_successfully'));
        return response(__('admin.global.updated_successfully'));
        
    }//end of status

}//end of controller