<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;
use Illuminate\Database\Eloquent\Model;

/**
 * The bridge is a way to connect the AI provider to the application.
 * It takes care of translating the AI provider's response to a format that the application can understand.
 */
interface Bridge
{
    /**
     * Return a new instance of the bridge.
     */
    public static function new(): self;

    /**
     * Set the provider for the bridge.
     * This is implemented in the HasProvider trait.
     * Bridges should implement this interface and use the trait.
     */
    public function withProvider(Provider $provider): self;

    /**
     * Get the provider for the bridge.
     * This is implemented in the HasProvider trait.
     * Bridges should implement this interface and use the trait.
     */
    public function provider(): Provider;

    /**
     * Set the isEphemeral flag for the bridge.
     * If true, the bridge will not save the model in the database.
     * This is implemented in the HasEpemeral trait.
     * Bridges should implement this interface and use the trait.
     */
    public function withIsEphemeral(bool $isEphemeral): self;

    /**
     * Get the isEphemeral flag for the bridge.
     * If true, the bridge will not save the model in the database.
     * This is implemented in the HasEpemeral trait.
     * Bridges should implement this interface and use the trait.
     */
    public function isEphemeral(): bool;

    /**
     * This function should return an array representation of the current bridge.
     */
    public function toArray(): array;

    /**
     * This function should import the current bridge into the application.
     * It should return the imported laravel model.
     */
    public function import(): Model;
}
