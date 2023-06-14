<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(getLanguages('default')->code);
});
