<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelAI\Models\Model;

final class ModelBridge implements Bridge
{
    use HasProvider;

    public string $externalId;
    public string $name;

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
            'provider'    => $this->provider
        ], array_merge(
            $this->toArray(),
            [
                'provider'  => $this->provider,
                'is_active' => true,
            ]
        ));
    }
}
