<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Image extends EloquentModel
{
    use HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "ai_images";

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
