<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(session()->put('cupon_code', '3gsfgs'), session()->get('cupon_code'));
});
