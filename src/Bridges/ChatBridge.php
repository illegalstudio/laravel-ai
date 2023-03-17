<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasNew;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illuminate\Database\Eloquent\Model;

final class ChatBridge implements Bridge
{
    use HasProvider, HasNew;

    public string $externalId;
    public array  $messages;

    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'messages'    => $this->messages,
        ];
    }

    public function import(): Model
    {
        throw new \Exception('Not implemented');
        // TODO: Implement import() method.
    }

    public function send($message): string
    {
        $this->messages[] = [
            'role'    => 'user',
            'content' => $message
        ];

        $response = $this->provider->getConnector()->chat('gpt-3.5-turbo', $this->messages);

        $this->messages[] = $response['message'];

        return $response['message']['content'];
    }
}
