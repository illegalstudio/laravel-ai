<?php

namespace Illegal\LaravelAI\Models;

use Illegal\LaravelAI\Contracts\BelongsToModel;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Completion extends EloquentModel
{
    use BelongsToModel;

    protected $fillable = [
        'model_id',
        'external_id',
        'prompt',
        'completion',
    ];
}
