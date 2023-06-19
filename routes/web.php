<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(session('currency_price'));
});
