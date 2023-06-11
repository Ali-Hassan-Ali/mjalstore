<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\market;
use App\Models\Card;

class ProductController extends Controller
{
    public function index(Category $subCategory)
    {
        $breadcrumb = ['#' => $subCategory->name];

    	return view('site.products.index', compact('subCategory', 'breadcrumb'));

    }//end of index

    public function market(Category $subCategory, market $market)
    {
        $breadcrumb = [route('site.sub_category', $subCategory->slug) => $subCategory->name, '#' => $market->name];

        return view('site.products.market', compact('subCategory', 'market', 'breadcrumb'));

    }//end of market

    public function marketShowCard(Category $subCategory, market $market, Card $card)
    {
        $cards      = $subCategory->cards()->limit(4)->inRandomOrder()->get();
        $breadcrumb = [
                        route('site.sub_category', $subCategory->slug) => $subCategory->name, 
                        route('site.market', ['sub_category' => $subCategory->slug, 'market' => $market->slug]) => $market->name,
                        '#' => $card->slug,
                     ];

        return view('site.products.show', compact('subCategory', 'market', 'card', 'cards', 'breadcrumb'));

    }//end of marketShowCard

    public function show(Category $subCategory, Card $card)
    {
        $cards = $subCategory->cards()->limit(4)->inRandomOrder()->get();

        $breadcrumb = [route('site.sub_category', $subCategory->slug) => $subCategory->name, '#' => $card->slug];

        return view('site.products.show', compact('subCategory', 'card', 'cards', 'breadcrumb'));

    }//end of show

}//end of controller