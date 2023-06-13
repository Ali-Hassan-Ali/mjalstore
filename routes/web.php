<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(\App\Models\Page::orderBy('order')->pluck('title', 'slug'));
        dd(getMulteSetting('faq', 'title', 1, 'ar'));
});
