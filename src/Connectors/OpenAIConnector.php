<?php

namespace Illegal\LaravelAI\Connectors;

use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Enums\Connectors;
use Illegal\LaravelAI\Objects\ModelObject;
use Illuminate\Support\Collection;
use OpenAI\Client;

class OpenAIConnector implements Connector
{
    /**
     * @inheritDoc
     */
    public const NAME = 'openai';

    /**
     * @param Client $client - The OpenAI client
     */
    public function __construct(protected Client $client) {}

    /**
     * @inheritDoc
     */
    public function listModels(): Collection
    {
        return Collection::make($this->client->models()->list()->data)->map(function ($model) {
            return (new ModelObject())->withConnector(Connectors::OpenAI)->withName($model->id ?? '')->withExternalId($model->id ?? '');
        });
    }
}
