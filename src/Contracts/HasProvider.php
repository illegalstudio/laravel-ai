<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;

trait HasProvider
{
    public Provider $provider;

    public function withProvider(Provider $provider): self
    {
        $this->provider = $provider;
        return $this;
    }
}
