<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "ai_models";

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
