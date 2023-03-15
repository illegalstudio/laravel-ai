<?php

namespace Illegal\LaravelAI\Enums;

use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Services\OpenAIConnector;

enum Connectors: string
{
    case OpenAI = "openai";

    public function getConnector(): Connector
    {
        return match ($this) {
            self::OpenAI => app(OpenAIConnector::class)
        };
    }
}
