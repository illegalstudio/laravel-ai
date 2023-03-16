<?php

namespace Illegal\LaravelAI\Facades\Bridges;

use Illegal\LaravelAI\Bridges\ModelBridge as Accessor;
use Illuminate\Support\Facades\Facade;

class ModelBridge extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Accessor::class;
    }
}
