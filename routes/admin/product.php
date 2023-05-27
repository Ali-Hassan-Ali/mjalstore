<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Products\MarketController;

//markets
Route::controller(MarketController::class)
    ->prefix('markets')->name('markets.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('markets', MarketController::class);