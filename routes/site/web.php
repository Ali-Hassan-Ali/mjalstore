<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\FastPurchaseController;
use App\Http\Controllers\Site\FooterController;


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

//product
Route::controller(FastPurchaseController::class)->group(function () {

        Route::get('fast_purchase', 'index')->name('fast_purchase.index');

    });

//footer
Route::controller(FooterController::class)->group(function () {

        Route::get('page/{page:slug}', 'PageIndex')->name('page.index');
        Route::get('faq', 'faqPage')->name('faq.index');
        Route::get('about', 'aboutPage')->name('about.index');
        Route::get('contact_us', 'contactUsPage')->name('contact.index');
        Route::post('contact_us', 'contactUsStore')->name('contact.store');

    });