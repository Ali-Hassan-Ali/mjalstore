<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\Settings\MediaRequest;
use Illuminate\Contracts\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        if(!permissionAdmin('read-settings')) {
            return abort(403);
        }

    	return view('admin.settings.media');

    }//end of index

    public function store(MediaRequest $request)
    {
        saveTransSetting('media_facebook', $request->media_facebook ?? '');
        saveTransSetting('media_twitter', $request->media_twitter ?? '');
        saveTransSetting('media_instagram', $request->media_instagram ?? '');
        saveTransSetting('media_video_links', $request->media_video_links ?? '');
        saveTransSetting('media_google_play', $request->media_google_play ?? '');
        saveTransSetting('media_apple_store', $request->media_apple_store ?? '');

        session()->flash('success', __('admin.global.updated_successfully'));
        return redirect()->back();

    }//end of index

}//end of controller