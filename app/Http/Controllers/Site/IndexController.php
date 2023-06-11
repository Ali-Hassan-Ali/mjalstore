<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Currency;

class IndexController extends Controller
{
    public function index()
    {
    	return view('site.index.index');

    }//end of index

    public function changeLanguage(Language $language)
    {
        if (!in_array($language->code, Language::pluck('code')->toArray())) {
            abort(400);
        }

        session()->put('code', $language->code);
        session()->put('dir', $language->dir);
        
        return redirect()->back();

    }//end of changeLanguage

    public function changeCurrency(Currency $currency)
    {
        if (!in_array($currency->code, Currency::pluck('code')->toArray())) {
            abort(400);
        }

        session()->put('currency_code', $language->code);
        session()->put('currency_name', $language->name);
        session()->put('currency_flag', $language->flag);
        
        return redirect()->back();

    }//end of changeLanguage

}//end of controller