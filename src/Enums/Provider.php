<?php

namespace Illegal\LaravelAI\Enums;

use Illegal\LaravelAI\Connectors\OpenAIConnector;
use Illegal\LaravelAI\Contracts\Connector;

/**
 * This is an enumeration of all possible providers
 */
enum Provider: string
{
    /**
     * The OpenAI provider. This is the only one supported at the moment.
     */
    case OpenAI = OpenAIConnector::NAME;

    /**
     * This method returns the connector for the provider
     *
     * @return Connector The connector for the provider
     */
    public function getConnector(): Connector
    {
        return match ($this) {
            self::OpenAI => app(OpenAIConnector::class)
        };
    }
}
