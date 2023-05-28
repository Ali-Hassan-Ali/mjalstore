<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\Settings\MetaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;

class MetaController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-settings')) {
            return abort(403);
        }

    	return view('admin.settings.meta');

    }//end of index

    public function store(MetaRequest $request)
    {
        if(empty($request->get('meta_title'))) {

            saveTransSetting('meta_title', '');
            saveTransSetting('meta_description', '');

        } else {

            saveTransSetting('meta_title', $request->meta_title);
            saveTransSetting('meta_description', $request->meta_description);
        }

        if(request()->file('meta_logo')) {

            if(!empty(getSetting('meta_logo'))) {

                Storage::disk('public')->delete(getSetting('meta_logo'));
            }


            $logo = request()->file('meta_logo')->store('settings', 'public');

            saveSetting('meta_logo', $logo);
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }//end of index

}//end of controller