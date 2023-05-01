<?php

namespace Illegal\LaravelAI;

use Illegal\LaravelAI\Commands\Chat;
use Illegal\LaravelAI\Commands\Complete;
use Illegal\LaravelAI\Commands\ImageGenerate;
use Illegal\LaravelAI\Commands\ModelsImport;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as IlluminateRouteServiceProvider;
use Route;

class RouteServiceProvider extends IlluminateRouteServiceProvider
{
    /**
     * Boot routes and commands
     */
    public function boot(): void
    {
        $this->_commands();
        $this->_routes();
    }

    /**
     * Register the commands
     */
    private function _commands(): void
    {
        $this->commands([
            Chat::class,
            Complete::class,
            ImageGenerate::class,
            ModelsImport::class,
        ]);
    }

    /**
     * Register the routes
     */
    private function _routes(): void
    {
        /**
         * Register the web routes, only if the interface is enabled
         */
        if (config('laravel-ai.interface.enabled')) {
            Route::middleware(LaravelAIAuth::webMiddleware())
                ->group(__DIR__.'/../routes/web.php');
        }
    }
}
