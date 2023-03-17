<?php

namespace Illegal\LaravelAI;

use Illegal\LaravelAi\Commands\Chat;
use Illegal\LaravelAI\Commands\ImportModels;
use Illegal\LaravelAI\Connectors\OpenAIConnector;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use OpenAI;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrations();
        $this->registerCommands();
        $this->mergeConfigurations();
        $this->configureDependencyInjection();
    }

    /**
     * Load the migrations
     */
    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations/'
        ]);
    }

    /**
     * Register the commands
     */
    private function registerCommands(): void
    {
        $this->commands([
            Chat::class,
            ImportModels::class,
        ]);
    }

    /**
     * Merge the config
     */
    private function mergeConfigurations(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/laravel-ai.php", "laravel-ai");
    }

    /**
     * Configure the Dependency Injection
     */
    private function configureDependencyInjection(): void
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
