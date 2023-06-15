<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Request\Site\ContactUsRequest;
use App\Models\Page;
use App\Models\ContactUs;

class FooterController extends Controller
{
    public function PageIndex(Page $page): View
    {
    	$breadcrumb = ['#' => $page->title];

    	return view('site.footers.page', compact('page', 'breadcrumb'));

    }//end of PageIndex

    public function faqPage(): View
    {
        $breadcrumb = ['#' => trans('settings.faq')];

        return view('site.footers.faq', compact('breadcrumb'));

    }//end of FaqPage

    public function aboutPage(): View
    {
        $breadcrumb = ['#' => trans('settings.about_page')];

        return view('site.footers.about', compact('breadcrumb'));

    }//end of aboutPage

    public function contactUsPage(): View
    {
        $breadcrumb = ['#' => trans('settings.contact')];

        return view('site.footers.contact_us', compact('breadcrumb'));

    }//end of contactUsPage

    public function contactUsStore(ContactUsRequest $request): Application | Response | ResponseFactory
    {
        return response(ContactUs::create($request->all()));

    }//end of contact Us store

}//end of controller