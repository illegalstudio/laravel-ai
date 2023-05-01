<?php

use Illegal\LaravelAI\Http\Controllers\ChatController;

Route::get('chat', [ChatController::class, 'index'])->name('chat');
