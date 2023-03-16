<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Enums\Provider;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = [
        'is_active',
        'name',
        'external_id',
        'provider',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'provider'  => Provider::class,
    ];
}
