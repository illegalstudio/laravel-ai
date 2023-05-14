<?php

use Illegal\LaravelAI\Http\Controllers\ChatController;
use Illegal\LaravelAI\Http\Controllers\ChatxController;
use Illegal\LaravelAI\LaravelAIAuth;

$admin = Route::prefix('laravel-ai');

if (config('laravel-ai.interface.auth.require_user')) {
    $admin->middleware(LaravelAIAuth::middleware());
}

$admin->group(function() {
    Route::resource('chat', ChatController::class)->except(['create', 'store', 'update']);
});
