<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\Settings\AboutPageRequest;
use App\Http\Request\Admin\Settings\FaqRequest;
use Illuminate\Support\Facades\Storage;
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
        if(request()->file('about_page_image')) {

            if(!empty(getSetting('about_page_image'))) {

                Storage::disk('public')->delete(getSetting('about_page_image'));
            }


            $image = request()->file('about_page_image')->store('settings', 'public');

            saveSetting('about_page_image', $image);
        }
        saveTransSetting('about_page_title', $request->about_page_title ?? '');
        saveTransSetting('about_page_description', $request->about_page_description ?? '');

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }//end of store

    public function faqPage(): View
    {
        if(!permissionAdmin('read-settings')) {
            return abort(403);
        }

        return view('admin.settings.faq.index');

    }//end of index

    public function faqStore(FaqRequest $request)
    {

        if (!empty($request->get('faq_title_' . getLanguages('default')->code))) {

            $itemTitle = [];
            $itemDisc  = [];

            foreach($request->get('faq_title_' . getLanguages('default')->code) as $indexName=>$name) {

                $itemsLangTitle = [];
                $itemsLangDisc = [];

                foreach(getLanguages() as $index=>$language) {

                    $itemsLangTitle[$language->code] = $request->get('faq_title_' . $language->code)[$indexName] ?? $request->get('faq_title_' . getLanguages('default')->code)[$indexName];
                    $itemsLangDisc[$language->code] = $request->get('faq_description_' . $language->code)[$indexName] ?? $request->get('faq_description_' . getLanguages('default')->code)[$indexName];;
                }

                $itemTitle[] = $itemsLangTitle;
                $itemDisc[]  = $itemsLangDisc;

            }

            $data = ['title' => $itemTitle, 'description' => $itemDisc];

            saveSetting('faq', json_encode($data));

        } else {

            saveSetting('faq', json_encode([]));

        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

    }//end of store

}//end of controller