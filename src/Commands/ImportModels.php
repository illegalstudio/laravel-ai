<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Contracts\ConsoleAIConnectorDependent;
use Illegal\LaravelAI\Models\Model;
use Illegal\LaravelAI\Bridges\ModelBridge;
use Illuminate\Console\Command;

class ImportModels extends Command
{
    use ConsoleAIConnectorDependent;

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
        $connector = $this->askforConnector();

        Model::whereProvider($connector::class)->update([
            'is_active' => false
        ]);

        $this->withProgressBar($connector->listModels(), function (ModelBridge $modelBridge) {
            $modelBridge->import();
        });
    }
}
