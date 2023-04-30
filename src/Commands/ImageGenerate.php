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

        /**
         * Ask for prompt
         */
        $prompt = $this->ask('Image prompt');

        /**
         * Ask for width and height
         */
        do {
            $width = (int) $this->ask('Image width', 256);

            if ($width < 1) {
                $this->error('Width must be greater than 0');
            }
        } while ($width < 1);

        do {
            $height = (int) $this->ask('Image height', 256);

            if ($height < 1) {
                $this->error('Height must be greater than 0');
            }
        } while ($height < 1);

        /**
         * Generate image
         */
        $this->info(
            'AI: '.
            ImageBridge::new()
                ->withProvider($provider)
                ->generate($prompt, $width, $height)
        );
    }
}
