<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Connectors;

/**
 * The bridge is a way to connect the AI provider to the application.
 */
interface Bridge
{
    /**
     * Set the connector for the bridge.
     * This is implemented in the HasConnector trait.
     * Bridges should implement this interface and use the trait.
     */
    public function withConnector(Connectors $connector): self;
}
