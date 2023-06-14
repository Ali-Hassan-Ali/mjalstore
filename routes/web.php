<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        return \App\Models\Category::subCategory()->with('markets.cards')->get()->groupBy('id');
        return collect(\App\Models\Category::subCategory()->get())->groupBy('parent_id');
        $items = [];
        foreach(\App\Models\Category::subCategory()->get() as $data) {
                $items[$data->parent_id] = $data->pluck('name','id');
        }
        return $items;
        // return \App\Models\Category::groupBy('name')->get();
});
