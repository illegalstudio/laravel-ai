<?php

namespace Illegal\LaravelAI;

use Exception;
use Illegal\InsideAuth\InsideAuth;
use Illegal\LaravelAI\Auth\Authentication;
use Illegal\LaravelAI\Commands\Chat;
use Illegal\LaravelAI\Commands\Complete;
use Illegal\LaravelAI\Commands\ImageGenerate;
use Illegal\LaravelAI\Commands\ModelsImport;
use Illegal\LaravelAI\Connectors\OpenAIConnector;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use OpenAI;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->dependencyInjection();
        $this->configuration();
    }

    /**
     * Bootstrap any application services.
     * @throws Exception
     */
    public function boot(): void
    {
        $this->migrations();
        $this->views();
        $this->auth();
    }

    /**
     * Load the migrations
     */
    private function migrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__.'/../database/migrations/'
        ]);
    }

    /**
     * Merge the config
     */
    private function configuration(): void
    {
        $this->mergeConfigFrom(__DIR__."/../config/laravel-ai.php", "laravel-ai");
    }

    /**
     * Configure the Dependency Injection
     */
    private function dependencyInjection(): void
    {
        /**
         * The OpenAI client
         */
        $this->app->singleton(OpenAI\Client::class, function () {
            return OpenAI::client(config('laravel-ai.openai.api_key'));
        });
        /**
         * The OpenAI connector
         */
        $this->app->singleton(OpenAIConnector::class, function (Application $app) {
            return (new OpenAIConnector($app->make(OpenAI\Client::class)))
                ->withDefaultMaxTokens(config('laravel-ai.openai.default_max_tokens'))
                ->withDefaultTemperature(config('laravel-ai.openai.default_temperature'));
        });
    }

    /**
     * Loads the views
     */
    private function views(): void
    {
        $this->loadViewsFrom(__DIR__."/../resources/views", "laravel-ai");
    }

    /**
     * Boot the authentication using illegal/insideauth package
     *
     * @throws Exception
     */
    private function auth(): void
    {
        /**
         * Boot authentication
         */
        InsideAuth::boot(config('laravel-ai.interface.auth.name'))
            ->enabled(
                config('laravel-ai.interface.enabled') && config('laravel-ai.interface.auth.enabled')
            )
            ->withoutEmailVerification(config('laravel-ai.interface.auth.disable.email_verification'))
            ->withoutRegistration(config('laravel-ai.interface.auth.disable.registration'))
            ->withoutForgotPassword(config('laravel-ai.interface.auth.disable.forgot_password'))
            ->withoutUserProfile(config('laravel-ai.interface.auth.disable.user_profile'))
            ->withDashboard('chat');

        $this->app->singleton(Authentication::class, function () {
            return new Authentication(config('laravel-ai.interface.auth.name'),
                config('laravel-ai.interface.auth.enabled'));
        });
    }
}
