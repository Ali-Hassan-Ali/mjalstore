<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        session()->has('currency_code') ? '' : session()->put([
            'currency_code' => getCurrency('default')?->code,
            'currency_name' => getCurrency('default')?->name,
            'currency_flag' => getCurrency('default')?->flag,
        ]);
    }
}
