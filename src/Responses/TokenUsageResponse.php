<?php

namespace Illegal\LaravelAI\Responses;

use Illegal\LaravelUtils\Contracts\HasNew;

class TokenUsageResponse
{
    use HasNew;

    private int $promptTokens = 0;
    private int $completionTokens = 0;
    private int $totalTokens = 0;

    /**
     * Setter for the promptTokens
     */
    public function withPromptTokens(int $promptTokens = 0): self
    {
        $this->promptTokens = $promptTokens;
        return $this;
    }

    /**
     * Getter for the promptTokens
     */
    public function promptTokens(): int
    {
        return $this->promptTokens;
    }

    /**
     * Setter for the completionTokens
     */
    public function withCompletionTokens(int $completionTokens = 0): self
    {
        $this->completionTokens = $completionTokens;
        return $this;
    }

    /**
     * Getter for the completionTokens
     */
    public function completionTokens(): int
    {
        return $this->completionTokens;
    }

    /**
     * Setter for the totalTokens
     */
    public function withTotalTokens(int $totalTokens = 0): self
    {
        $this->totalTokens = $totalTokens;
        return $this;
    }

    /**
     * Getter for the totalTokens
     */
    public function totalTokens(): int
    {
        return $this->totalTokens;
    }

    /**
     * Populates the object from an array
     */
    public function fromArray(array $array): self
    {
        return $this
            ->withPromptTokens($array['prompt_tokens'] ?? 0)
            ->withCompletionTokens($array['completion_tokens'] ?? 0)
            ->withTotalTokens($array['total_tokens'] ?? 0);
    }

    /**
     * Returns an array representation of the object
     */
    public function toArray(): array
    {
        return [
            'prompt_tokens'     => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens'      => $this->totalTokens,
        ];
    }
}
