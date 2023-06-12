<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(getMulteSetting('faq', 'title', 1, 'ar'));
});
