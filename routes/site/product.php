<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Products\CartController;
use App\Http\Controllers\Site\Products\ProductController;


//cart
Route::controller(CartController::class)
	->prefix('cart')->name('cart.')->group(function () {

        Route::get('/', 'cart')->name('index');
        Route::get('purchase_now/{card}', 'add')->name('add.purchase_now');
        Route::get('add/{card}', 'add')->name('add');
        Route::delete('delete/{card}', 'delete')->name('delete');
        Route::put('update', 'update')->name('update');

    });

//product
Route::controller(ProductController::class)->group(function () {

        Route::get('sub_category/{sub_category:slug}', 'index')->name('sub_category');
        Route::get('sub_category/{sub_category:slug}/market/{market:slug}', 'market')->name('market');
        Route::get('sub_category/{sub_category:slug}/market/{market:slug}/card/{card:slug}', 'marketShowCard')->name('show.market.card');
        Route::get('sub_category/{sub_category:slug}/card/{card:slug}', 'show')->name('show.card');

    });