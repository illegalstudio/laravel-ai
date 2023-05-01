<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Bridges\ModelBridge;
use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illegal\LaravelAI\Models\Model;
use Illuminate\Console\Command;

class ModelsImport extends Command
{
    use ConsoleProviderDependent;

    /**
     * @var string The signature of the console command.
     */
    protected $signature = 'ai:models:import';

    /**
     * @var string The description of the console command.
     */
    protected $description = 'Import models from AI provider';

    public function handle(): void
    {
        $provider = $this->askForProvider();

        Model::whereProvider($provider->value)->update([
            'is_active' => false
        ]);

        $this->withProgressBar($provider->getConnector()->listModels(), function (ModelBridge $modelBridge) {
            $modelBridge->import();
        });
    }
}
