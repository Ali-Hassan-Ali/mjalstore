<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Auth\AuthController;
use App\Http\Controllers\Site\Auth\ProfileController;


//auth
Route::controller(AuthController::class)->group(function () {

        Route::get('login', 'loginPage')->name('login.index');
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
        Route::post('logout', 'logout')->name('logout');

    });

//profile
Route::controller(ProfileController::class)->group(function () {

        Route::get('profile/{user:username}', 'index')->name('profile');
        Route::post('profile/update', 'update')->name('profile.update');

    });