<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Contracts\ConsoleProviderDependent;
use Illegal\LaravelAI\Models\Model;
use Illegal\LaravelAI\Bridges\ModelBridge;
use Illuminate\Console\Command;

class ImportModels extends Command
{
    use ConsoleProviderDependent;

    /**
     * @var string The signature of the console command.
     */
    protected $signature = 'ai:import-models';

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
