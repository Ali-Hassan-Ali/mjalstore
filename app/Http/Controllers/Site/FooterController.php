<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Request\Site\ContactUsRequest;
use App\Models\Page;
use App\Models\ContactUs;

class FooterController extends Controller
{
    public function PageIndex(Page $page)
    {
    	$breadcrumb = ['#' => $page->title];

    	return view('site.footers.page', compact('page', 'breadcrumb'));

    }//end of PageIndex

    public function faqPage()
    {
        $breadcrumb = ['#' => trans('settings.faq')];

        return view('site.footers.faq', compact('breadcrumb'));

    }//end of FaqPage

    public function aboutPage()
    {
        $breadcrumb = ['#' => trans('settings.about_page')];

        return view('site.footers.about', compact('breadcrumb'));

    }//end of aboutPage

    public function contactUsPage()
    {
        $breadcrumb = ['#' => trans('settings.contact')];

        return view('site.footers.contact_us', compact('breadcrumb'));

    }//end of contactUsPage

    public function contactUsStore(ContactUsRequest $request)
    {
        return ContactUs::create($request->all());

    }//end of contact Us store

}//end of controller