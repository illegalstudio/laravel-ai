<?php

namespace Illegal\LaravelAI\Commands;

use Exception;
use Illegal\LaravelAI\Bridges\ChatBridge;
use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illuminate\Console\Command;

class Chat extends Command
{
    use ConsoleProviderDependent;

    protected $signature = 'ai:chat {--E|ephemeral}';

    protected $description = 'Chat with AI';

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        /**
         * Gather the ephemeral option. If true, the data of the request will not be stored in the database
         */
        $isEphemeral = $this->option('ephemeral');

        /**
         * Ask for provider
         */
        $provider = $this->askForProvider();

        /**
         * Build the bridge
         */
        $chat = ChatBridge::new()
            ->withProvider($provider)
            ->withModel('gpt-3.5-turbo')
            ->withIsEphemeral($isEphemeral);

        /**
         * Start the chat loop
         */
        while (1) {
            /**
             * Ask for prompt
             */
            $message = $this->ask('You');
            if ($message === 'exit') {
                break;
            }
            $this->info('AI: '.$chat->send($message));
        }
    }
}
