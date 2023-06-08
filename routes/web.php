<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('login', 'admin.auth.login')->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/test', function () {

    dd(str_replace('.', '-', 'fgsfg.sf'));
    $subCategories = \App\Models\Category::subCategory()->get()->random(rand(2, 6))->pluck('id')->toArray();

    dd($subCategories);
});
