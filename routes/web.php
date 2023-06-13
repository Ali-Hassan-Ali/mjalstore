<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(\App\Models\PaymentMethod::orderBy('order')->pluck('image'));
});
