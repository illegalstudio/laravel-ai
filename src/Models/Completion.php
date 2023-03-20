<?php

namespace Illegal\LaravelAI\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Completion extends EloquentModel
{
    protected $fillable = [
        'model_id',
        'external_id',
        'prompt',
        'completion',
    ];
}