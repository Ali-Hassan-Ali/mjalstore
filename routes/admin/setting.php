<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Settings\WebsitController;
use App\Http\Controllers\Admin\Settings\MetaController;

//settings
Route::controller(MetaController::class)->group(function () {

    Route::get('meta', 'index')->name('meta.index');
    Route::post('meta/store', 'store')->name('meta.store');

});