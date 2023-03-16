<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;

/**
 * @method choice( string $string, array|string[] $choices, string $value )
 */
trait ConsoleAIConnectorDependent
{
    public function askforConnector(): Connector
    {
        $provider = $this->choice(
            'Choose a provider',
            array_map(function ($item) {
                return $item->value;
            }, Provider::cases()),
            Provider::OpenAI->value
        );

        return Provider::from($provider)->getConnector();
    }

}
