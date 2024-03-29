<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasEphemeral;
use Illegal\LaravelAI\Contracts\HasModel;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAI\Models\ApiRequest;
use Illegal\LaravelAI\Models\Chat;
use Illegal\LaravelAI\Responses\TokenUsageResponse;
use Illegal\LaravelUtils\Contracts\HasNew;
use Illuminate\Database\Eloquent\Model;

final class ChatBridge implements Bridge
{
    use HasProvider, HasEphemeral, HasModel, HasNew;

    /**
     * @var string|null $externalId The external id of the chat, returned by the provider
     */
    private ?string $externalId = null;

    /**
     * @var array $messages The messages sent and received in the chat
     */
    private array $messages = [];

    /**
     * @var Chat|null $chat The corresponding chat model
     */
    private ?Chat $chat = null;

    /**
     * Setter for the external id
     */
    public function withExternalId(string $externalId = null): self
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
     * Setter for the messages
     */
    public function withMessages(array $messages = null): self
    {
        $this->messages = $messages ?? [];
        return $this;
    }

    /**
     * Getter for the messages
     */
    public function messages(): array
    {
        return $this->messages;
    }

    /**
     * Setter for the chat
     */
    public function withChat(Chat $chat): self
    {
        $this->chat = $chat;

        $this->withModel($chat->model)
            ->withExternalId($chat->external_id)
            ->withMessages($chat->messages);

        return $this;
    }

    /**
     * Getter for the chat
     */
    public function chat(): ?Chat
    {
        return $this->chat;
    }

    /**
     * Returns a representation of the chat as an array
     */
    public function toArray(): array
    {
        return [
            'model_id'    => $this->model?->id,
            'external_id' => $this->externalId,
            'messages'    => $this->messages,
        ];
    }

    /**
     * Import the chat data into a Model
     */
    public function import(): Model
    {
        $this->chat = $this->chat ?? (new Chat);
        $this->chat->forceFill($this->toArray())->save();

        return $this->chat;
    }

    /**
     * Save the request to the database, with the corresponding token usage
     */
    public function saveRequest(TokenUsageResponse $tokenUsage): ApiRequest
    {
        $apiRequest              = ApiRequest::new()->fill($tokenUsage->toArray());
        $apiRequest->external_id = $this->externalId();

        if ($this->chat()) {
            $apiRequest->requestable()->associate($this->chat());
        }

        $apiRequest->save();
        return $apiRequest;
    }

    /**
     * Send a message to the chat
     *
     * @param  string  $message  The message to send
     */
    public function send(string $message): string
    {
        /**
         * Append the message to the messages array
         */
        $this->messages[] = [
            'role'    => 'user',
            'content' => $message
        ];

        /**
         * Get the response from the provider, in the TextResponse format
         */
        $response = $this->provider->getConnector()->chat($this->model->external_id, $this->messages);

        /**
         * Populate local data
         */
        $this->externalId = $response->externalId();
        $this->messages   = array_merge($this->messages, [$response->message()->toArray()]);

        /**
         * 1. Import into a model, only if the request is not ephemeral
         * 2. Save the request
         */
        if (!$this->isEphemeral()) {
            $this->import();
        }
        $this->saveRequest($response->tokenUsage());

        /**
         * Return the content of the response
         */
        return $response->message()->content();
    }
}
