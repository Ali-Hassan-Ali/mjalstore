<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\WebsitRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;

class WebsitController extends Controller
{
    public function index(): View
    {
    	return view('admin.settings.website');

    }//end of index

    public function store(WebsitRequest $request)
    {
        if(empty($request->get('feature_title' . app()->getLocale()))) {

            saveTransSetting('system_name', '');
            saveTransSetting('system_description', '');

        } else {

            saveTransSetting('system_name', $request->system_name);
            saveTransSetting('system_description', $request->system_description);
        }

        if(request()->file('image')) {

            if(!empty(getSetting('system_image'))) {

                Storage::disk('public')->delete(getSetting('system_image'));
            }


            $image = request()->file('image')->store('settings', 'public');

            saveSetting('system_image', $image);
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }//end of index

}//end of controller