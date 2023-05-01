<?php

namespace Illegal\LaravelAI\Commands;

use Exception;
use Illegal\LaravelAI\Bridges\CompletionBridge;
use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illuminate\Console\Command;

class Complete extends Command
{
    use ConsoleProviderDependent;

    protected $signature = 'ai:complete {--E|ephemeral}';

    protected $description = 'Use the AI to complete your prompt';

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
         * Start the complete loop
         */
        while (1) {
            /**
             * Ask for max tokens and temperaturek
             */
            $maxTokens   = $this->ask('Max tokens (leave empty to use defaults)', null);
            $temperature = $this->ask('Temperature (leave empty to use defaults)', null);

            /**
             * Ask for prompt
             */
            $message = $this->ask('You');
            if ($message === 'exit') {
                break;
            }

            $this->info(
                'AI: '.
                CompletionBridge::new()
                    ->withProvider($provider)
                    ->withModel('text-davinci-003')
                    ->withIsEphemeral($isEphemeral)
                    ->complete($message, $maxTokens, $temperature)
            );
        }
    }
}
