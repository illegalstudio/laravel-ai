<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;

/**
 * @method choice( string $string, array|string[] $choices, string $value )
 */
trait ConsoleProviderDependent
{
    public function askForProvider(): Provider
    {
        $provider = $this->choice(
            'Choose a provider',
            array_map(function ($item) {
                return $item->value;
            }, Provider::cases()),
            Provider::OpenAI->value
        );

        return Provider::from($provider);
    }

}
