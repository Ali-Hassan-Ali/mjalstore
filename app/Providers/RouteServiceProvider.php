<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            //site folder
            Route::middleware('web', 'SetLocale')
                ->name('site.')
                ->group(base_path('routes/site/web.php'));

            Route::middleware('web', 'SetLocale')
                ->name('site.auth.')
                ->group(base_path('routes/site/auth.php'));

            //admin folder
            Route::middleware('web', 'SetLocale')
                ->name('admin.')->prefix('admin')
                ->group(base_path('routes/admin/web.php'));

            Route::middleware('web', 'SetLocale', 'auth:admin')
                ->name('admin.settings.')->prefix('admin/settings')
                ->group(base_path('routes/admin/setting.php'));

            Route::middleware('web', 'SetLocale', 'auth:admin')
                ->name('admin.products.')->prefix('admin/products')
                ->group(base_path('routes/admin/product.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
