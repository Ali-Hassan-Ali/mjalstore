<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Products\MarketController;
use App\Http\Controllers\Admin\Products\CardController;

//markets
Route::controller(MarketController::class)
    ->prefix('markets')->name('markets.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('markets', MarketController::class);

//cards
Route::controller(CardController::class)
    ->prefix('cards')->name('cards.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('cards', CardController::class);