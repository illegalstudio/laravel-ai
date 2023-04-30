<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasModel;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAI\Models\ApiRequest;
use Illegal\LaravelAI\Models\Completion;
use Illegal\LaravelAI\Responses\TokenUsageResponse;
use Illegal\LaravelUtils\Contracts\HasNew;
use Illuminate\Database\Eloquent\Model;

class CompletionBridge implements Bridge
{
    use HasProvider, HasModel, HasNew;

    /**
     * @var string|null $externalId The external id of the completion, returned by the provider
     */
    private ?string $externalId = null;

    /**
     * @var string|null $prompt The prompt of the completion, provided by the user
     */
    private ?string $prompt = null;

    /**
     * @var string|null $answer The answer to the prompt, returned by the provider
     */
    private ?string $answer = null;

    /**
     * @var Completion|null $completion The corresponding completion model
     */
    private ?Completion $completion = null;

    /**
     * Setter for the external id
     */
    public function withExternalId(string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * Getter for the external id
     */
    public function externalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * Setter for the prompt
     */
    public function withPrompt(string $prompt): self
    {
        $this->prompt = $prompt;
        return $this;
    }

    /**
     * Getter for the prompt
     */
    public function prompt(): ?string
    {
        return $this->prompt;
    }

    /**
     * Setter for the answer
     */
    public function withAnswer(string $answer): self
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * Getter for the answer
     */
    public function answer(): ?string
    {
        return $this->answer;
    }

    /**
     * Setter for the completion
     */
    public function withCompletion(Completion $completion): self
    {
        $this->completion = $completion;

        $this->withModel($completion->model)
            ->withExternalId($completion->external_id)
            ->withPrompt($completion->prompt)
            ->withAnswer($completion->answer);

        return $this;
    }

    /**
     * Getter for the completion
     */
    public function completion(): ?Completion
    {
        return $this->completion;
    }

    /**
     * Returns the array representation of the bridge
     */
    public function toArray(): array
    {
        return [
            'model_id'    => $this->model?->id,
            'external_id' => $this->externalId(),
            'prompt'      => $this->prompt(),
            'answer'      => $this->answer(),
        ];
    }

    /**
     * Import the bridge into a model
     */
    public function import(): Model
    {
        $this->completion = $this->completion ?? (new Completion);
        $this->completion->forceFill($this->toArray())->save();

        return $this->completion;
    }

    /**
     * Save the request to the database, with the corresponding token usage
     */
    public function saveRequest(TokenUsageResponse $tokenUsage): ApiRequest
    {
        $apiRequest              = ApiRequest::new()->fill($tokenUsage->toArray());
        $apiRequest->external_id = $this->externalId();

        if ($this->completion()) {
            $apiRequest->requestable()->associate($this->completion());
        }

        $apiRequest->save();
        return $apiRequest;
    }

    /**
     * Ask the provider to complete the given text
     */
    public function complete(string $text, int $maxTokens = null, float $temperature = null): string
    {
        /**
         * Get the response from the provider, in the TextResponse format
         */
        $response = $this->provider()->getConnector()->complete($this->model->external_id, $text, $maxTokens,
            $temperature);

        /**
         * Populate local data
         */
        $this->externalId = $response->externalId();
        $this->prompt     = $text;
        $this->answer     = $response->message()->content();

        /**
         * 1. Import into a model
         * 2. Save the request
         */
        $this->import();
        $this->saveRequest($response->tokenUsage());

        /**
         * Return the content of the response
         */
        return $response->message()->content();
    }
}
