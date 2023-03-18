<?php

namespace Illegal\LaravelAI\Connectors;

use Exception;
use Illegal\LaravelAI\Contracts\Connector;
use Illegal\LaravelAI\Enums\Provider;
use Illegal\LaravelAI\Bridges\ModelBridge;
use Illegal\LaravelAI\Responses\MessageResponse;
use Illegal\LaravelAI\Responses\TextResponse;
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
     * @var int $defaultMaxTokens - The default max tokens for the OpenAI API
     */
    private int $defaultMaxTokens = 5;

    /**
     * @var float $defaultTemperature - The default temperature for the OpenAI API
     */
    private float $defaultTemperature = 0;

    /**
     * @param Client $client - The OpenAI client
     */
    public function __construct(protected Client $client)
    {
    }

    /**
     * Setter for the default max tokens
     */
    public function withDefaultMaxTokens(int $maxTokens): self
    {
        $this->defaultMaxTokens = $maxTokens;
        return $this;
    }

    /**
     * Setter for the default temperature
     */
    public function withDefaultTemperature(float $temperature): self
    {
        $this->defaultTemperature = $temperature;
        return $this;
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
    public function complete(string $model, string $prompt, int $maxTokens = null, float $temperature = null): TextResponse
    {
        $response = $this->client->completions()->create([
            'model'       => $model,
            'prompt'      => $prompt,
            'max_tokens'  => $maxTokens ?? $this->defaultMaxTokens,
            'temperature' => $temperature ?? $this->defaultTemperature,
        ]);

        $contents = [];

        foreach ($response->choices as $result) {
            $contents[] = $result->text;
        }

        return TextResponse::new()->withExternalId($response->id)->withMessage(
            MessageResponse::new()->withContent(implode("\n--\n", $contents))->withRole('assistant')
        );
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function chat(string $model, array|string $messages): TextResponse
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

        $response = TextResponse::new()->withExternalId($chat->id);

        foreach ($chat->choices as $choice) {
            $response->withMessage(
                MessageResponse::new()->withContent($choice->message->content)->withRole($choice->message->role)
            );
        }

        return $response;
    }
}
