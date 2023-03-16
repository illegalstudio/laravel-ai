<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Connectors;

trait HasConnector
{
    public Connectors $connector;

    public function withConnector(Connectors $connector): self
    {
        $this->connector = $connector;
        return $this;
    }
}
