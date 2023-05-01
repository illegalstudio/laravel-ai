<?php

namespace Illegal\LaravelAI\Http\Controllers;

use Illuminate\Routing\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('laravel-ai::chat');
    }
}
