<?php

use Illegal\LaravelAI\Http\Controllers\ChatController;
use Illegal\LaravelAI\LaravelAIAuth;

$admin = Route::prefix('laravel-ai');

if (config('laravel-ai.interface.auth.require_user')) {
    $admin->middleware(LaravelAIAuth::middleware());
}

$admin->group(function() {
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
});
