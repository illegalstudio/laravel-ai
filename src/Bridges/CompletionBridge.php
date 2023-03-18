<?php

namespace Illegal\LaravelAI\Bridges;

use Exception;
use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasModel;
use Illegal\LaravelAI\Contracts\HasNew;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAi\Models\Completion;
use Illuminate\Database\Eloquent\Model;

class CompletionBridge implements Bridge
{
    use HasProvider, HasModel, HasNew;

    /**
     * @var string $externalId The external id of the completion, returned by the provider
     */
    private string $externalId;

    /**
     * @var string $prompt The prompt of the completion, provided by the user
     */
    private string $prompt;

    /**
     * @var string $answer The answer to the prompt, returned by the provider
     */
    private string $answer;

    /**
     * @var Completion $completion The corresponding completion model
     */
    private Completion $completion;

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
    public function externalId(): string
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
    public function prompt(): string
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
    public function answer(): string
    {
        return $this->answer;
    }

    /**
     * Setter for the completion
     */
    public function withCompletion(Completion $completion): self
    {
        $this->completion = $completion;

        $this->withExternalId($completion->external_id);
        $this->withPrompt($completion->prompt);
        $this->withAnswer($completion->answer);

        return $this;
    }

    /**
     * Getter for the completion
     */
    public function completion(): Completion
    {
        return $this->completion;
    }

    /**
     * Returns the array representation of the bridge
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * @throws Exception
     */
    public function import(): Model
    {
        throw new Exception('Not implemented');
    }

    /**
     * Ask the provider to complete the given text
     *
     * @throws Exception
     */
    public function complete(string $text): string
    {
        $response = $this->provider()->getConnector()->complete($this->model->external_id, $text);

        $this->completion = $this->completion ?? ( new Completion );
        $this->completion->forceFill([
            'model_id'    => $this->model->id,
            'external_id' => $response->externalId(),
            'prompt'      => $text,
            'answer'      => $response->message()->content(),
        ])->save();

        $this->withCompletion($this->completion);

        return $response->message()->content();
    }
}
