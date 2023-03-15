<?php

namespace Illegal\LaravelAI\Objects;

final class ModelObject
{
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
}
