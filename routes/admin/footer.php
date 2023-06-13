<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Footers\PageController;
use App\Http\Controllers\Admin\Footers\PaymentMethodController;

//pages
Route::controller(PageController::class)
    ->prefix('pages')->name('pages.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('pages', PageController::class);

//payment_methods
Route::controller(PaymentMethodController::class)
    ->prefix('payment_methods')->name('payment_methods.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

    });
Route::resource('payment_methods', PaymentMethodController::class);