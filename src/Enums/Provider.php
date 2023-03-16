<?php

namespace Illegal\LaravelAI\Enums;

use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Connectors\OpenAIConnector;

enum Provider: string
{
    case OpenAI = OpenAIConnector::NAME;

    public function getConnector(): Connector
    {
        return match ($this) {
            self::OpenAI => app(OpenAIConnector::class)
        };
    }
}
