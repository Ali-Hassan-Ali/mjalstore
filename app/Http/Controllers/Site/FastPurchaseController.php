<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Currency;

class FastPurchaseController extends Controller
{
    public function index(): View
    {
    	$breadcrumb = ['#' => trans('site.fast_purchase')];

    	return view('site.index.fast_purchase', compact('breadcrumb'));

    }//end of index

}//end of controller