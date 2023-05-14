<?php

namespace Illegal\LaravelAI\Http\Livewire;

use Illegal\LaravelAI\Models\Chat;
use Illegal\LaravelUtils\Contracts\Livewire\Sortable;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Link;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ChatList extends Component
{
    use WithPagination, Sortable;

    /**
     * @var array $queryString The query string to persist
     */
    protected $queryString = [];

    public function __construct($id = null)
    {
        $this->sortDefaultField = Link::getField('created_at');
        $this->sortFields       = [
            'created_at' => Link::getField('created_at'),
        ];

        $this->queryString = [
            'sortField'     => ['except' => $this->sortDefaultField],
            'sortDirection' => ['except' => $this->sortDirection]
        ];

        parent::__construct($id);
    }

    /**
     * @return Factory|Application|View
     */
    public function render(): Factory|Application|View
    {
        return view('laravel-ai::livewire.chat-list', [
            'chats' => Chat::paginate(10)
        ]);
    }

    /**
     * Get the pagination view.
     */
    public function paginationView(): string
    {
        return 'laravel-ai::livewire._parts.paginator';
    }
}
