<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelUtils\Contracts\HasNew;
use Illegal\LaravelUtils\Contracts\HasPrefix;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ApiRequest extends Model
{
    use HasPrefix, HasNew;

    /**
     * This is just a placeholder, has the name will be set by
     * the HasPrefix trait.
     *
     * @var string The table name.
     */
    protected $table = "ai_api_requests";

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'prompt_tokens',
        'completion_tokens',
        'total_tokens'
    ];

    /**
     * @inheritdoc
     */
    protected function getPrefix(): string
    {
        return config('laravel-ai.db.prefix');
    }

    /**
     * The requestable model for which this request was made.
     */
    public function requestable(): MorphTo
    {
        return $this->morphTo();
    }
}
