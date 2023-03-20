<?php

namespace Illegal\LaravelAI\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Image extends EloquentModel
{
    protected $fillable = [
        'model_id',
        'prompt',
        'width',
        'height',
        'url'
    ];
}
