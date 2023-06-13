<?php

namespace App\Http\Controllers\Admin\Footers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Footers\PaymentMethod\PaymentMethodRequest;
use App\Http\Request\Admin\Footers\PaymentMethod\StatusRequest;
use App\Http\Request\Admin\Footers\PaymentMethod\DeleteRequest;
use App\Services\DatatableServices;
use App\models\PaymentMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class PaymentMethodController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-payment_methods')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' => route('admin.footers.payment_methods.data'),
                'route_status' => route('admin.footers.payment_methods.status'),
                'header'  => [
                    'site.image',
                    'site.admin',
                    'site.status',
                ],
                'columns' => [
                    'image'  => 'image',
                    'admin'  => 'admin',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.footers.payment_methods.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-payment_methods',
            'update' => 'update-payment_methods',
            'delete' => 'delete-payment_methods',
        ];

        $paymentMethod = PaymentMethod::all();

        return dataTables()->of($paymentMethod)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (PaymentMethod $paymentMethod) => $paymentMethod?->created_at?->format('Y-m-d'))
            ->addColumn('admin', fn (PaymentMethod $paymentMethod) => $paymentMethod?->admin?->name)
            ->editColumn('image', function(PaymentMethod $paymentMethod) {
                return view('admin.dataTables.image', ['models' => $paymentMethod]);
            })
            ->addColumn('actions', function(PaymentMethod $paymentMethod) use($permissions) {
                $routeEdit   = route('admin.footers.payment_methods.edit', $paymentMethod->id);
                $routeDelete = '';
                if(!$paymentMethod->default) {
                    $routeDelete = route('admin.footers.payment_methods.destroy', $paymentMethod->id);
                }
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete'));
            })
            ->addColumn('status', function(PaymentMethod $paymentMethod) use($permissions) {
                if(!$paymentMethod->default) {
                    return view('admin.dataTables.status', ['models' => $paymentMethod, 'permissions' => $permissions]);
                }
            })
            ->rawColumns(['record_select', 'actions', 'status'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        if(!permissionAdmin('create-payment_methods')) {
            return abort(403);
        }

        return view('admin.footers.payment_methods.create');
        
    }//end of create

    //RedirectResponse
    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        $requestData = request()->except(['image']);

        if(request()->file('image')) {

            $requestData['image'] = request()->file('image')->store('payment_methods', 'public');

        }

        PaymentMethod::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.footers.payment_methods.index');

    }//end of store

    public function edit(PaymentMethod $paymentMethod): View
    {
        if(!permissionAdmin('update-payment_methods')) {
            return abort(403);
        }

        return view('admin.footers.payment_methods.edit', compact('paymentMethod'));

    }//end of edit

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $requestData = request()->except(['image']);

        if(request()->has('image')) {

            $paymentMethod->image ? Storage::disk('public')->delete($paymentMethod->image) : '';

            $requestData['image'] = request()->file('image')->store('payment_methods', 'public');

        }

        $paymentMethod->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.footers.payment_methods.index');
        
    }//end of update

    public function destroy(PaymentMethod $paymentMethod): Application | Response | ResponseFactory
    {
        if(!$paymentMethod->default) {

            $paymentMethod->image ? Storage::disk('public')->delete($paymentMethod->image) : '';
            $paymentMethod->delete();
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request)
    {
        $images = PaymentMethod::where('default', 0)->find(request()->ids ?? [])->whereNotNull('image')->pluck('image')->toArray();
        count($images) > 0 ? Storage::disk('public')->delete($images) : '';
        PaymentMethod::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $paymentMethod = PaymentMethod::find($request->id);
        $paymentMethod?->update(['status' => !$paymentMethod->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

    public function changeDefault(StatusRequest $request): Application | Response | ResponseFactory
    {
        PaymentMethod::each(fn ($paymentMethod) => $paymentMethod->update(['default' => 0]));
        PaymentMethod::find($request->id)->update(['default' => 1, 'status' => 1]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller