<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;

/**
 * The bridge is a way to connect the AI provider to the application.
 * It takes care of translating the AI provider's response to a format that the application can understand.
 */
interface Bridge
{
    /**
     * Set the provider for the bridge.
     * This is implemented in the HasProvider trait.
     * Bridges should implement this interface and use the trait.
     */
    public function withProvider(Provider $provider): self;
}
