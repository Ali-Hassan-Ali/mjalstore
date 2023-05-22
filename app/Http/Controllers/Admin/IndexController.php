<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\Language;

class IndexController extends Controller
{
    public function index()
    {
        // dd(app()->getLocale());
    	return view('admin.home');

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

}//end of controller