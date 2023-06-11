<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
        dd(\App\Models\Category::limit(4)->inRandomOrder()->pluck('id')->toArray());
});
