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
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            Route::prefix('api')->middleware('api')->group(base_path('routes/api.php'));
            Route::prefix('api/admin')->middleware(['api', 'auth:api'])->name('admin.')->group(base_path('routes/admin.php'));
            Route::prefix('parser')->group(base_path('routes/parser.php'));
        });
    }

    /**
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
