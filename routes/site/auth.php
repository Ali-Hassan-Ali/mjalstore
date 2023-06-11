<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Auth\AuthController;
use App\Http\Controllers\Site\Auth\ProfileController;


//auth
Route::controller(AuthController::class)
        ->prefix('site/auth')->group(function () {

        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');

    });

//profile
Route::controller(ProfileController::class)->group(function () {

        Route::get('profile/{user:username}', 'index')->name('profile');
        Route::get('profile/update/{user:username}', 'update')->name('profile.update');

    });