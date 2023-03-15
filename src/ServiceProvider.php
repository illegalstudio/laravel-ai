<?php

namespace Illegal\LaravelAI;

use Illegal\LaravelAI\Commands\InteractCommand;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{

    public function boot(): void
    {
        $this->commands([
            InteractCommand::class,
        ]);
    }

    public function register(): void
    {
    }

}
