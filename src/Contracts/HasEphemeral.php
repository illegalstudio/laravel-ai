<?php

namespace Illegal\LaravelAI\Contracts;

trait HasEphemeral
{
    /**
     * @var bool $isEphemeral Whether the bridge is ephemeral or not (i.e. whether it should save in the database or not)
     */
    protected bool $isEphemeral = false;

    /**
     * Setter for the isEphemeral property
     */
    public function withIsEphemeral(bool $isEphemeral): self
    {
        $this->isEphemeral = $isEphemeral;
        return $this;
    }

    /**
     * Getter for the isEphemeral property
     */
    public function isEphemeral(): bool
    {
        return $this->isEphemeral;
    }
}
