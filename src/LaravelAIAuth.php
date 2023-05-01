<?php

namespace Illegal\LaravelAI;

use Illegal\LaravelAI\Auth\Authentication;

/**
 * @mixin Authentication
 * @see Authentication
 */
class LaravelAIAuth extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor(): string
    {
        return Authentication::class;
    }
}
