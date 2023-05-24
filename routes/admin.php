<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

use App\Http\Controllers\Admin\Managements\LanguageController;
use App\Http\Controllers\Admin\Managements\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login/store', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([
    'auth:admin'
])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('language/{language:code}', [IndexController::class, 'changeLanguage'])->name('changeLanguage');

    //managements
    Route::name('managements.')->prefix('managements')->group(function() {

        //admins
        Route::controller(AdminController::class)
            ->prefix('admins')->name('admins.')
            ->group(function () {

                Route::get('data', 'data')->name('data');
                Route::post('status', 'status')->name('status');
                Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

            });
        Route::resource('admins', AdminController::class);

        //roles
        Route::controller(RoleController::class)
            ->prefix('roles')->name('roles.')
            ->group(function () {

                Route::get('data', 'data')->name('data');
                Route::post('status', 'status')->name('status');
                Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

            });
        Route::resource('roles', RoleController::class);

        //roles
        Route::controller(LanguageController::class)
            ->prefix('languages')->name('languages.')
            ->group(function () {

                Route::get('data', 'data')->name('data');
                Route::post('default', 'changeDefault')->name('default');
                Route::post('status', 'status')->name('status');
                Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

            });
        Route::resource('languages', LanguageController::class);

    });//end of managements


    //categories
    Route::controller(CategoryController::class)
        ->prefix('categories')->name('categories.')
        ->group(function () {

            Route::get('data', 'data')->name('data');
            Route::post('status', 'status')->name('status');
            Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

        });
    Route::resource('categories', CategoryController::class);

    //sub_categories
    Route::controller(SubCategoryController::class)
        ->prefix('sub_categories')->name('sub_categories.')
        ->group(function () {

            Route::get('data', 'data')->name('data');
            Route::post('status', 'status')->name('status');
            Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');

        });
    Route::resource('sub_categories', SubCategoryController::class);


});
