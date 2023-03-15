<?php

namespace Illegal\LaravelAI\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = [
        'name',
        'external_id',
        'connector',
    ];
}
