<?php

namespace Illegal\LaravelAI\Http\Livewire;

use Illegal\LaravelAI\Bridges\ChatBridge;
use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelAI\Models\Chat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ChatComponent extends Component
{

    /**
     * @var ChatBridge $chatBridge The chat bridge used to communicate with the AI
     */
    protected ChatBridge $chatBridge;

    /**
     * @var Chat|null $chat The chat to use, can be null
     */
    public ?Chat $chat = null;

    /**
     * @var array $messages The messages to display
     */
    public array $messages = [];

    /**
     * @var string $message The current message in the input, to be sent to the AI
     */
    public string $message = "";

    /**
     * Once the component is mounted, we create a new chat bridge and set the messages
     */
    public function booted(): void
    {
        $this->chatBridge = ChatBridge::new()
            ->withProvider(Provider::OpenAI)
            ->withModel('gpt-3.5-turbo');

        if (null !== $this->chat) {
            $this->chatBridge->withChat($this->chat);
        }

        $this->messages = $this->chatBridge->messages();
    }

    /**
     * Render the component.
     */
    public function render(): Factory|Application|View
    {
        return view('laravel-ai::livewire.chat-component');
    }

    /**
     * Send the chat message to the AI, refresh the messages and reset the message input
     */
    public function sendChat(): void
    {
        $this->chatBridge->send($this->message);
        $this->messages = $this->chatBridge->messages();
        $this->message  = "";

        /**
         * Refresh the chat object to the one holded by the bridge
         */
        if (null === $this->chat) {
            $this->chat = $this->chatBridge->chat();
        }

        $this->dispatchBrowserEvent('scroll-to-bottom');
    }
}
