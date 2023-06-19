<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Products\CurrencyPrice\CurrencyPriceRequest;
use App\Http\Request\Admin\Products\CurrencyPrice\StatusRequest;
use App\Http\Request\Admin\Products\CurrencyPrice\DeleteRequest;
use App\Services\DatatableServices;
use App\models\CurrencyPrice;
use App\models\Currency;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class CurrencyPriceController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-currency_prices')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.currency_prices.data'),
                'header'  => [
                    'admin.global.code',
                    'admin.global.price',
                    'admin.global.admin',
                ],
                'columns' => [
                    'code'   => 'code',
                    'price'  => 'price',
                    'admin'  => 'admin',
                ]
            ]
        );

        return view('admin.products.currency_prices.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-currency_prices',
            'update' => 'update-currency_prices',
            'delete' => 'delete-currency_prices',
        ];

        $currencyPricePrice = CurrencyPrice::query();

        return dataTables()->of($currencyPricePrice)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (CurrencyPrice $currencyPricePrice) => $currencyPricePrice?->created_at?->format('Y-m-d'))
            ->addColumn('code', fn (CurrencyPrice $currencyPricePrice) => $currencyPricePrice?->currency?->code)
            ->addColumn('admin', fn (CurrencyPrice $currencyPricePrice) => $currencyPricePrice?->admin?->name)
            ->addColumn('actions', function(CurrencyPrice $currencyPricePrice) use($permissions) {
                $routeEdit   = route('admin.products.currency_prices.edit', $currencyPricePrice->id);
                $routeDelete = route('admin.products.currency_prices.destroy', $currencyPricePrice->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->rawColumns(['record_select', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-currency_prices')) {
            return abort(403);
        }

        $currencies = Currency::pluck('code', 'id')->toArray();

        return view('admin.products.currency_prices.create', compact('currencies'));
        
    }//end of create

    //RedirectResponse
    public function store(CurrencyPriceRequest $request): RedirectResponse
    {
        foreach ($request->price as $id=>$price) {

            $data = [
                'price'      => $price,
                'currency_id'=> $id,
                'admin_id'   => request()->admin_id,
                'created_at' => now(),
            ];

            CurrencyPrice::updateOrCreate(
                [
                    'price'       => $price,
                    'currency_id' => $id,
                ],

                $data
            );
        }

        session()->flash('success', __('admin.global.added_successfully'));
        return redirect()->route('admin.products.currency_prices.index');

    }//end of store

    public function edit(CurrencyPrice $currencyPrice): View
    {
        if(!permissionAdmin('update-currency_prices')) {
            return abort(403);
        }

        return view('admin.products.currency_prices.edit', compact('currencyPrice'));

    }//end of edit

    public function update(CurrencyPriceRequest $request, CurrencyPrice $currencyPrice): RedirectResponse
    {
        $currencyPrice->update(request()->all());

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->route('admin.products.currency_prices.index');
        
    }//end of update

    public function destroy(CurrencyPrice $currencyPrice): Application | Response | ResponseFactory
    {
        $currencyPrice->delete();

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        CurrencyPrice::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.global.deleted_successfully'));
        return response(__('admin.global.deleted_successfully'));

    }//end of bulkDelete

}//end of controller