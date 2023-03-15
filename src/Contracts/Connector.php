<?php

namespace Illegal\LaravelAI\Contracts;

use Illuminate\Support\Collection;

interface Connector
{
    public function listModels(): Collection;
}
