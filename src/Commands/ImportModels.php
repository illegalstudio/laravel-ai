<?php

namespace Illegal\LaravelAI\Commands;

use Illegal\LaravelAI\Contracts\ConsoleAIConnectorDependent;
use Illegal\LaravelAI\Models\Model;
use Illegal\LaravelAI\Objects\ModelObject;
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
    protected $description = 'Import models from AI connectors';

    public function handle(): void
    {
        $connector = $this->askforConnector();

        $this->withProgressBar($connector->listModels(), function (ModelObject $model) use ($connector) {
            Model::updateOrCreate([
                'external_id' => $model->externalId,
                'connector'   => $connector::class,
            ], array_merge(
                $model->toArray(),
                ['connector' => $connector::class]
            ));
        });
    }

}
