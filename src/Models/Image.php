<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Image extends EloquentModel
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
        'model_id',
        'prompt',
        'width',
        'height',
        'url'
    ];
}
