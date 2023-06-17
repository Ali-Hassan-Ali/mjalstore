<?php

namespace App\Http\Controllers\Admin\Footers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Request\Admin\Footers\ContactUs\StatusRequest;
use App\Http\Request\Admin\Footers\ContactUs\DeleteRequest;
use App\Services\DatatableServices;
use App\models\ContactUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class ContactUsController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-contact_us')) {
            return abort(403);
        }

        $datatables = (new DatatableServices())->header(
            [
                'route' 	   => route('admin.footers.contact_us.data'),
                'route_status' => route('admin.footers.contact_us.status'),
                'header'  => [
                    'admin.global.name',
                    'admin.global.email',
                    'admin.footers.contact_us.subject',
                    'admin.footers.contact_us.body',
                    'admin.global.read',
                ],
                'columns' => [
                    'name'   => 'name',
                    'email'  => 'email',
                    'subject'=> 'subject',
                    'body'   => 'body',
                    'status' => 'status',
                ]
            ]
        );

        return view('admin.footers.contact_us.index', compact('datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => 'status-contact_us',
            'delete' => 'delete-contact_us',
            'read'   => 'read-contact_us',
        ];

        $contactU = ContactUs::query();

        return dataTables()->of($contactU)
            ->addColumn('record_select', 'admin.dataTables.record_select')
            ->addColumn('created_at', fn (ContactUs $contactU) => $contactU?->created_at?->format('Y-m-d'))
            ->addColumn('subject', fn (ContactUs $contactU) => str()->limit($contactU?->subject, 60))
            ->addColumn('actions', function(ContactUs $contactU) use($permissions) {
            	$routeEdit   = '';
                $routeRead   = route('admin.footers.contact_us.show', $contactU->id);
                $routeDelete = route('admin.footers.contact_us.destroy', $contactU->id);
                return view('admin.dataTables.actions', compact('permissions', 'routeEdit', 'routeDelete', 'routeRead'));
            })
            ->addColumn('status', function(ContactUs $contactU) use($permissions) {
                return view('admin.dataTables.status', ['models' => $contactU, 'permissions' => $permissions]);
            })
            ->rawColumns(['record_select', 'actions', 'status', 'description'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function show(ContactUs $contactU): View
    {
        if(!permissionAdmin('read-contact_us')) {
            return abort(403);
        }

        return view('admin.footers.contact_us.show', compact('contactU'));

    }//end of show

    public function destroy(ContactUs $contactU): Application | Response | ResponseFactory
    {
        $contactU->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        ContactUs::destroy(request()->ids ?? []);

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $contactU = ContactUs::find($request->id);
        $contactU->update(['status' => !$contactU->status]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        
    }//end of status

}//end of controller