<?php

namespace Illegal\LaravelAI\Contracts;

use Illegal\LaravelAI\Enums\Provider;

trait HasProvider
{
    /**
     * @var Provider $provider - The provider
     */
    private Provider $provider;

    /**
     * Setter for the provider
     */
    public function withProvider(Provider $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Getter for the provider
     */
    public function provider(): Provider
    {
        return $this->provider;
    }
}
