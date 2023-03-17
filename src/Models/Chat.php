<?php

namespace Illegal\LaravelAI\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Chat extends EloquentModel
{
    protected $fillable = [
        'model_id',
        'external_id',
        'messages',
    ];

    protected $casts = [
        'messages' => 'array',
    ];
}
