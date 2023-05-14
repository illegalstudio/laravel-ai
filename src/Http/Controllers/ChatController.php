<?php

namespace Illegal\LaravelAI\Http\Controllers;

use App\Http\Controllers\Controller;
use Illegal\LaravelAI\Models\Chat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * List all chats
     */
    public function index()
    {
        return view('laravel-ai::chat.index');
    }

    /**
     * Start a new chat
     */
    public function create()
    {
        return view('laravel-ai::chat.create');
    }

    /**
     * Not supported, as chat are managed via a livewire component
     */
    public function store(Request $request): void
    {
        abort(404, 'Not Found');
    }

    /**
     * Redirect to edit, as show and edit, in a chat contest, are the same
     */
    public function show(Chat $chat): RedirectResponse
    {
        return redirect()->route('laravel-ai.chat.edit', $chat);
    }

    /**
     * Shows the widget to chat with the AI
     */
    public function edit(Chat $chat)
    {
        return view('laravel-ai::chat.edit', compact('chat'));
    }

    /**
     * Not supported, as chat are managed via a livewire component
     */
    public function update(): void
    {
        abort(404, 'Not Found');
    }

    /**
     * Destroy the resource and redirect to index
     */
    public function destroy(Chat $chat): RedirectResponse
    {
        return redirect()->route('laravel-ai.chat.index');
    }
}
