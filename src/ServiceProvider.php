<?php

namespace Illegal\LaravelAI;

use Illegal\LaravelAI\Commands\ImportModels;
use Illegal\LaravelAI\Services\OpenAIConnector;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use OpenAI;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootCommands();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerMergeConfig();
        $this->registerDI();
    }

    /**
     * Register the migrations
     */
    private function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations/'
        ]);
    }

    /**
     * Register the commands
     */
    private function bootCommands(): void
    {
        $this->commands([
            ImportModels::class,
        ]);
    }

    /**
     * Register the config
     */
    private function registerMergeConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/laravel-ai.php", "laravel-ai");
    }

    /**
     * Register the Dependency Injection
     */
    private function registerDI(): void
    {
        /**
         * The OpenAI client
         */
        $this->app->singleton(OpenAI\Client::class, function ($app) {
            return OpenAI::client(config('laravel-ai.openai.api_key'));
        });
        /**
         * The OpenAI connector
         */
        $this->app->singleton(OpenAIConnector::class, function ($app) {
            return new OpenAIConnector($app->make(OpenAI\Client::class));
        });
    }

}
