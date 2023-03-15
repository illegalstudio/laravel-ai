<?php

namespace Illegal\LaravelAI\Services;

use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Objects\ModelObject;
use Illuminate\Support\Collection;
use OpenAI\Client;

class OpenAIConnector implements Connector
{
    public function __construct(protected Client $client) {}

    public function listModels(): Collection
    {
        return Collection::make($this->client->models()->list()->data)->map(function ($model) {
            return (new ModelObject())->withName($model->id ?? '')->withExternalId($model->id ?? '');
        });
    }
}
