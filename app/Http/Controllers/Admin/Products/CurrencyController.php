<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Products\Currency\CurrencyRequest;
use App\Http\Request\Admin\Products\Currency\StatusRequest;
use App\Http\Request\Admin\Products\Currency\DeleteRequest;
use App\Services\DatatableServices;
use App\models\Currency;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CurrencyController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-currencies')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.currencies.data'),
                'route_status' => route('admin.products.currencies.status'),
                'header'  => [
                    'admin.global.name',
                    'admin.global.code',
                    'admin.global.flag',
                    'admin.global.default',
                    'admin.global.admin',
                    'admin.global.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'code'   => 'code',
                    'flag'   => 'flag',
                    'default'=> 'default',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.products.currencies.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-currencies',
            'update' => 'update-currencies',
            'delete' => 'delete-currencies',
        ];

        $currency = Currency::query();

        return dataTables()->of($currency)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (Currency $currency) => $currency?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (Currency $currency) => $currency?->admin?->name)
            ->addColumn('name', fn (Currency $currency) => $currency?->name)
            ->addColumn('actions', function(Currency $currency) use($permissions) {
                $routeEdit   = route('admin.products.currencies.edit', $currency->id);
                $routeDelete = '';
                if(!$currency->default) {
                    $routeDelete = route('admin.products.currencies.destroy', $currency->id);
                }
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Currency $currency) use($permissions) {
                if(!$currency->default) {
                    return view('admin.dataTables.status', ['models' => $currency, 'permissions' => $permissions]);
                }
            })
            ->addColumn('default', function(Currency $currency) {
                return view('admin.products.currencies.data_tables.check_default', compact('currency'));
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-currencies')) {
            return abort(403);
        }

        return view('admin.products.currencies.create');
        
    }//end of create

    //RedirectResponse
    public function store(CurrencyRequest $request): RedirectResponse
    {
        Currency::create(request()->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.products.currencies.index');

    }//end of store

    public function edit(Currency $currency): View
    {
        if(!permissionAdmin('update-currencies')) {
            return abort(403);
        }

        return view('admin.products.currencies.edit', compact('currency'));

    }//end of edit

    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update(request()->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.products.currencies.index');
        
    }//end of update

    public function destroy(Currency $currency): Application | Response | ResponseFactory
    {
        if(!$currency->default) {

            $currency->flag ? Storage::disk('public')->delete($currency->flag) : '';
            $currency->delete();
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        // $images = Currency::where('default', 0)->find(request()->ids ?? [])->pluck('flag')->toArray();
        // Storage::disk('public')->delete($images) ?? '';
        Currency::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $currency = Currency::find($request->id);
        $currency?->update(['status' => !$currency->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

    public function changeDefault(StatusRequest $request): Application | Response | ResponseFactory
    {
        Currency::each(fn ($currency) => $currency->update(['default' => 0]));
        Currency::find($request->id)->update(['default' => 1, 'status' => 1]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller