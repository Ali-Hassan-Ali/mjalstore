<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

    dd(\App\Models\Admin::role('admin')->get());
});