<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\Settings\AboutPageRequest;
use Illuminate\Contracts\View\View;

class FooterController extends Controller
{
    public function aboutPage(): View
    {
        if(!permissionAdmin('read-settings')) {
            return abort(403);
        }

    	return view('admin.settings.about_page');

    }//end of index

    public function aboutPageStore(AboutPageRequest $request)
    {
        saveTransSetting('about_page_title', $request->about_page_title ?? '');
        saveTransSetting('about_page_description', $request->about_page_description ?? '');

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }//end of store

}//end of controller