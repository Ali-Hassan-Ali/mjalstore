<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Products\MarketController;
use App\Http\Controllers\Admin\Products\CardController;
use App\Http\Controllers\Admin\Products\CurrencyController;

//cards
Route::controller(CardController::class)
    ->prefix('cards')->name('cards.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
        Route::get('sub_categories/{category}', 'category')->name('get.sub_categories');
        Route::get('markets/{sub_category}', 'markets')->name('get.markets');

    });
Route::resource('cards', CardController::class);

//markets
Route::controller(MarketController::class)
    ->prefix('markets')->name('markets.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('markets', MarketController::class);

//currency
Route::controller(CurrencyController::class)
    ->prefix('currencies')->name('currencies.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::post('default', 'changeDefault')->name('default');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('currencies', CurrencyController::class);
