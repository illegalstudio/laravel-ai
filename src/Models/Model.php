<?php

namespace Illegal\LaravelAI\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = [
        'is_active',
        'name',
        'external_id',
        'connector',
    ];
}
