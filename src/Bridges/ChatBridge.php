<?php

namespace Illegal\LaravelAI\Bridges;

use Exception;
use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasModel;
use Illegal\LaravelAI\Contracts\HasNew;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAI\Models\Chat;
use Illuminate\Database\Eloquent\Model;

final class ChatBridge implements Bridge
{
    use HasProvider, HasModel, HasNew;

    /**
     * @var string $externalId The external id of the chat, returned by the provider
     */
    private string $externalId;

    /**
     * @var array $messages The messages sent and received in the chat
     */
    private array $messages;

    /**
     * @var Chat $chat The corresponding chat model
     */
    private Chat $chat;

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
     * Setter for the messages
     */
    public function withMessages(array $messages): self
    {
        $this->messages = $messages;
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

        $this->withExternalId($chat->external_id);
        $this->withMessages($chat->messages);

        return $this;
    }

    /**
     * Getter for the chat
     */
    public function chat(): Chat
    {
        return $this->chat;
    }

    /**
     * Returns a representation of the chat as an array
     */
    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'messages'    => $this->messages,
        ];
    }

    /**
     * The import method is not implemented for the chat bridge
     *
     * @throws Exception
     */
    public function import(): Model
    {
        throw new Exception('Not implemented');
    }

    /**
     * Send a message to the chat
     *
     * @throws Exception
     */
    public function send($message): string
    {
        $this->messages[] = [
            'role'    => 'user',
            'content' => $message
        ];

        /**
         * Get the response from the provider, in the TextResponse format
         */
        $response = $this->provider->getConnector()->chat($this->model->external_id, $this->messages);

        /**
         * Update or create the chat model
         */
        $this->chat = $this->chat ?? ( new Chat );
        $this->chat->forceFill([
            'model_id'    => $this->model->id,
            'external_id' => $response->externalId(),
            'messages'    => array_merge($this->messages, [$response->message()->toArray()])
        ])->save();

        /**
         * Refresh the bridge with the new chat.
         * This will update the messages and external id
         */
        $this->withChat($this->chat);

        /**
         * Return the content of the response
         */
        return $response->message()->content();
    }
}
