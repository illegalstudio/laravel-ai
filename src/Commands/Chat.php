<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Bridges\ChatBridge;
use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illuminate\Console\Command;

class Chat extends Command
{
    use ConsoleProviderDependent;

    protected $signature = 'ai:chat';

    protected $description = 'Chat with AI';

    public function handle(): void
    {
        $provider = $this->askForProvider();

        $chat = ChatBridge::new()->withProvider($provider);

        while(1) {
            $message = $this->ask('You');
            if ($message === 'exit') {
                break;
            }
            $this->info('AI: ' . $chat->send($message));
        }
    }
}
