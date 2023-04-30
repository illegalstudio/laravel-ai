<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Contracts\BelongsToModel;
use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Chat extends EloquentModel
{
    use BelongsToModel, HasPrefix;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "ai_chats";

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
        'external_id',
        'messages',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'messages' => 'array',
    ];
}
