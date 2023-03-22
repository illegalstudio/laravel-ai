<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This trait should be used by Eloquent models
 * that belong to an AI model
 */
trait BelongsToModel
{
    /**
     * The relation with the model
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class);
    }
}
