<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Bridges\ImageBridge;
use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illuminate\Console\Command;

class ImageGenerate extends Command
{
    use ConsoleProviderDependent;

    protected $signature = 'ai:image:generate';

    protected $description = 'Command description';

    public function handle(): void
    {
        $provider = $this->askForProvider();

        $prompt = $this->ask('You');

        $this->info(
            'AI: ' .
            ImageBridge::new()
                ->withProvider($provider)
                ->generate($prompt, 256, 256)
        );
    }
}
