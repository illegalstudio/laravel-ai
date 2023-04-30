<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasPrefix;

    /**
     * @inheritdoc
     */
    protected function getPrefix(): string
    {
        return config('laravel-ai.db.prefix');
    }

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'is_active',
        'name',
        'external_id',
        'provider',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'is_active' => 'boolean',
        'provider'  => Provider::class,
    ];
}
