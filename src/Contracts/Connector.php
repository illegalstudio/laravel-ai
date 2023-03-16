<?php

namespace Illegal\LaravelAI\Contracts;

use Illuminate\Support\Collection;

interface Connector
{
    /**
     * The name of the connector/provider.
     * It will be used to identify the connector in the database and to provide
     * an easy way to identify the connector.
     */
    public const NAME = 'base';

    /**
     * List all models available for this connector.
     * Typically this function will retrieve the list though the API of the provider.
     * Should return a collection of ModelObject objects.
     * @return Collection
     */
    public function listModels(): Collection;
}
