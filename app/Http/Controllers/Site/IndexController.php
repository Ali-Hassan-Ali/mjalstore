<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Language;
use App\Models\Currency;

class IndexController extends Controller
{
    public function index(): View
    {
    	return view('site.index.index');

    }//end of index

    public function changeLanguage(Language $language): RedirectResponse
    {
        if (!in_array($language->code, Language::pluck('code')->toArray())) {
            abort(400);
        }

        session()->put('code', $language->code);
        session()->put('dir', $language->dir);

        $name = json_decode(\DB::table('currencies')->where('code', session('currency_code'))->first()?->name, true);

        if ($name) {
            
            session()->has('currency_name') ? session()->put('currency_name', $name[$language->code]) : '';

        }

        
        return redirect()->back();

    }//end of changeLanguage

    public function changeCurrency(Currency $currency): RedirectResponse
    {
        if (!in_array($currency->code, Currency::pluck('code')->toArray())) {
            abort(400);
        }

        if ($currency->currencyPrice()->count()) {
            
            session()->put('currency_code', $currency->code);
            session()->put('currency_price', $currency->currencyPrice->price);
            session()->put('currency_name', $currency->name);
            session()->put('currency_flag', $currency->flag);

        } else {

            session()->forget(['currency_code', 'currency_price', 'currency_name', 'currency_flag']);
            session()->forget('currency_code');
            session()->forget('currency_name');
            session()->forget('currency_name');
            session()->forget('currency_flag');

        }//end of if
        
        return redirect()->back();

    }//end of changeLanguage

}//end of controller