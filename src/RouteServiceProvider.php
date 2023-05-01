<?php

namespace Illegal\LaravelAI;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as IlluminateRouteServiceProvider;
use Route;

class RouteServiceProvider extends IlluminateRouteServiceProvider
{
    public function boot(): void
    {
        Route::middleware([
            LaravelAIAuth::webMiddleware(),
            LaravelAIAuth::middleware()
        ])
            ->group(__DIR__.'/../routes/web.php');
    }

}
