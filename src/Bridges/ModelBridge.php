<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Enums\Connectors;
use Illegal\LaravelAI\Models\Model;

final class ModelBridge
{
    public Connectors $connector;
    public string     $externalId;
    public string     $name;

    public function withConnector(Connectors $connector): self
    {
        $this->connector = $connector;
        return $this;
    }

    public function withExternalId(string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'name'        => $this->name,
        ];
    }

    public function import(): Model
    {
        return Model::updateOrCreate([
            'external_id' => $this->externalId,
            'connector'   => $this->connector
        ], array_merge(
            $this->toArray(),
            [
                'connector' => $this->connector,
                'is_active' => true,
            ]
        ));
    }
}
