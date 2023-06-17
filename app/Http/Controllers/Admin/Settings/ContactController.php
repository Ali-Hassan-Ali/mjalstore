<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\Settings\ContactRequest;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-settings')) {
            return abort(403);
        }

    	return view('admin.settings.contact');

    }//end of index

    public function store(ContactRequest $request)
    {
        saveTransSetting('contact_phone', $request->contact_phone ?? '');
        saveTransSetting('contact_email', $request->contact_email ?? '');
        saveTransSetting('contact_address', $request->contact_address ?? '');
        saveTransSetting('contact_address_link', $request->contact_address_link ?? '');

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->back();

    }//end of index

}//end of controller