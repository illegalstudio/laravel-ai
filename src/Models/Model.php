<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Enums\Connectors;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = [
        'is_active',
        'name',
        'external_id',
        'connector',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'connector' => Connectors::class,
    ];
}
