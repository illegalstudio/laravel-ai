<?php

namespace Illegal\LaravelAI\Facades;

use Illegal\LaravelAI\Services\OpenAIConnector as Accessor;
use Illuminate\Support\Facades\Facade;

class OpenAIConnector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Accessor::class;
    }
}
