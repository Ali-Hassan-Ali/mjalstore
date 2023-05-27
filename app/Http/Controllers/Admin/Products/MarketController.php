<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Category;
use App\Http\Request\Admin\Products\Market\MarketRequest;
use App\Http\Request\Admin\Products\Market\StatusRequest;
use App\Http\Request\Admin\Products\Market\DeleteRequest;
use App\Services\DatatableServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class MarketController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-markets')) {
            return abort(403);
        }
        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.products.markets.data'),
                'route_status' => route('admin.products.markets.status'),
                'header'  => [
                    'site.name',
                    'site.flag',
                    'site.admin',
                    'site.sub_category',
                    'site.status',
                ],
                'columns' => [
                    'name'   => 'name',
                    'flag'   => 'flag',
                    'admin'  => 'admin',
                    'sub_category' => 'sub_category',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.products.markets.index', compact('datatables'));

    }//end of index

    public function data()
    {
        $permissions = [
            'status' => permissionAdmin('status-markets'),
            'update' => permissionAdmin('update-markets'),
            'delete' => permissionAdmin('delete-markets'),
        ];

        $market = Market::query();

        return dataTables()->of($market)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn(Market $market) => $market->created_at->format('Y-m-d'))
            ->addColumn('admin', fn(Market $market) => $market?->admin?->name)
            ->addColumn('sub_category', fn(Market $market) => $market?->subCategory?->name)
            ->editColumn('flag', function(Market $market) {
                return view('admin.dataTables.image', ['models' => $market]);
            })
            ->addColumn('actions', function(Market $market) use($permissions) {
                $routeEdit   = route('admin.products.markets.edit', $market->id);
                $routeDelete = route('admin.products.markets.destroy', $market->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(Market $market) use($permissions) {
                return view('admin.dataTables.status', ['models' => $market, 'permissions' => $permissions]);
            })
            ->addColumn('name', fn(Market $market) => $market->name ?? '')
            ->rawColumns(['record_select', 'actions', 'status', 'name', 'flag'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-markets')) {
            return abort(403);
        }

        $subCategories = Category::subCategory()->pluck('name', 'id');

        return view('admin.products.markets.create', compact('subCategories'));

    }//end of create

    public function store(MarketRequest $request): RedirectResponse
    {
        $requestData = request()->except('flag');

        if(request()->file('flag')) {

            $requestData['flag'] = request()->file('flag')->store('markets', 'public');

        }

        Market::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.products.markets.index');

    }//end of store

    public function edit(Market $market): View
    {
        if(!permissionAdmin('update-markets')) {
            return abort(403);
        }

        $subCategories = Category::subCategory()->pluck('name', 'id');

        return view('admin.products.markets.edit', compact('market', 'subCategories'));

    }//end of edit

    public function update(MarketRequest $request, Market $market): RedirectResponse
    {
        $requestData = request()->except('flag');
        if(request()->file('flag')) {

            Storage::disk('public')->delete($market->flag);

            $requestData['flag'] = request()->file('flag')->store('markets', 'public');

        }
        $market->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.products.markets.index');

    }//end of update

    public function destroy(Market $market): Application | Response | ResponseFactory
    {
        if($market->flag) {
            Storage::disk('public')->delete($market->flag);
        }
        $market->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = Market::find(request()->ids ?? [])->pluck('flag')->toArray();
        Storage::disk('public')->delete($images) ?? '';
        Market::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request)
    {
        $market = Market::find($request->id);
        $market->update(['status' => !$market->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));

    }//end of status

}//end of controller
