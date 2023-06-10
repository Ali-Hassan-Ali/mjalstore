<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;


//index
Route::controller(IndexController::class)
    ->name('site.')->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('language/{language:code}', 'changeLanguage')->name('changeLanguage');

    });

// Route::get('language/{language:code}', [IndexController::class, 'changeLanguage'])->name('changeLanguage');

// Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/test', function () {

return \App\Models\Category::query()->with('subCategoriesRelation')->get();
dd(\App\Models\Category::query()->with('subCategoriesRelation')->pluck('name', 'id'));
    dd(str_replace('.', '-', 'fgsfg.sf'));
    $subCategories = \App\Models\Category::subCategory()->get()->random(rand(2, 6))->pluck('id')->toArray();

    dd($subCategories);
});
