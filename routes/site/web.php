<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\ProductController;


//index
Route::controller(IndexController::class)->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('language/{language:code}', 'changeLanguage')->name('changeLanguage');
        Route::get('currency/{currency:code}', 'changeCurrency')->name('changeCurrency');

    });

//product
Route::controller(ProductController::class)->group(function () {

        Route::get('sub_category/{sub_category:slug}', 'index')->name('sub_category');
        Route::get('sub_category/{sub_category:slug}/market/{market:slug}', 'market')->name('market');
        Route::get('sub_category/{sub_category:slug}/market/{market:slug}/card/{card:slug}', 'marketShowCard')->name('show.market.card');
        Route::get('sub_category/{sub_category:slug}/card/{card:slug}', 'show')->name('show.card');

    });