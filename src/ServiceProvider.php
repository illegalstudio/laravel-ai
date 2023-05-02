<?php

namespace Illegal\LaravelAI;

use Exception;
use Illegal\InsideAuth\InsideAuth;
use Illegal\LaravelAI\Auth\Authentication;
use Illegal\LaravelAI\Connectors\OpenAIConnector;
use Illegal\LaravelAI\Http\Livewire\ChatComponent;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Livewire;
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
        $this->livewire();
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

        /**
         * Register helper singleton
         */
        $this->app->singleton(Authentication::class, function () {
            return new Authentication(config('laravel-ai.interface.auth.name'),
                config('laravel-ai.interface.auth.enabled'));
        });

        /**
         * Add the middleware use to check if the user is logged in
         * to the list of persistent middleware that will be applied
         * on subsequent requests by livewire.
         */
        Livewire::addPersistentMiddleware(LaravelAIAuth::middlewareClasses());
    }

    /**
     * Register the livewire components
     */
    private function livewire(): void
    {
        Livewire::component('laravel-ai::chat', ChatComponent::class);
    }
}
