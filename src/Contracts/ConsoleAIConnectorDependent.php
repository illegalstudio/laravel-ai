<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Connectors;

/**
 * @method choice( string $string, array|string[] $choices, string $value )
 */
trait ConsoleAIConnectorDependent
{
    public function askforConnector(): Connector
    {
        $connector = $this->choice(
            'Choose a connector',
            array_map(function ($item) {
                return $item->value;
            }, Connectors::cases()),
            Connectors::OpenAI->value
        );

        return Connectors::from($connector)->getConnector();
    }

}
