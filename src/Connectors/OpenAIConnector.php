<?php

namespace Illegal\LaravelAI\Connectors;

use Exception;
use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelAI\Bridges\ModelBridge;
use Illuminate\Support\Collection;
use OpenAI\Client;

/**
 * The Connector for the OpenAI provider
 */
class OpenAIConnector implements Connector
{
    /**
     * @inheritDoc
     */
    public const NAME = 'openai';

    /**
     * @param Client $client - The OpenAI client
     */
    public function __construct(protected Client $client)
    {
    }

    /**
     * @inheritDoc
     */
    public function listModels(): Collection
    {
        return Collection::make($this->client->models()->list()->data)->map(function ($model) {
            return ModelBridge::new()->withProvider(Provider::OpenAI)
                ->withName($model->id ?? '')
                ->withExternalId($model->id ?? '');
        });
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function complete(string $model, string $prompt, int $maxTokens, float $temperature): void
    {
        $response = $this->client->completions()->create([
            'model'       => $model,
            'prompt'      => $prompt,
            'max_tokens'  => $maxTokens,
            'temperature' => $temperature,
        ]);

        foreach ($response->choices as $result) {
            var_dump($result->text);
        }
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function chat(string $model, array|string $messages): array
    {
        $messages = is_array($messages) ? $messages : [
            [
                'role'    => 'user',
                'content' => $messages
            ]
        ];

        $chat = $this->client->chat()->create([
            'model'    => $model,
            'messages' => $messages
        ]);

        $response = [
            'external_id' => $chat->id,
        ];

        foreach ($chat->choices as $choice) {
            $response['message'] = [
                'role'    => $choice->message->role,
                'content' => $choice->message->content
            ];
        }

        return $response;
    }
}
