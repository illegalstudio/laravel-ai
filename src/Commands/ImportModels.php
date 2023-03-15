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

        Model::whereConnector($connector::class)->update([
            'is_active' => false
        ]);

        $this->withProgressBar($connector->listModels(), function (ModelObject $modelObject) use ($connector) {
            Model::updateOrCreate([
                'external_id' => $modelObject->externalId,
                'connector'   => $connector::class,
            ], array_merge(
                $modelObject->toArray(),
                [
                    'connector' => $connector::class,
                    'is_active' => true,
                ]
            ));
        });
    }

}
