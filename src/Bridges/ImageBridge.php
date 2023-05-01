<?php

namespace Illegal\LaravelAI\Bridges;

use Illegal\LaravelAI\Contracts\Bridge;
use Illegal\LaravelAI\Contracts\HasEphemeral;
use Illegal\LaravelAI\Contracts\HasModel;
use Illegal\LaravelAI\Contracts\HasProvider;
use Illegal\LaravelAI\Models\ApiRequest;
use Illegal\LaravelAI\Models\Image;
use Illegal\LaravelAI\Responses\TokenUsageResponse;
use Illegal\LaravelUtils\Contracts\HasNew;
use Illuminate\Database\Eloquent\Model;

class ImageBridge implements Bridge
{
    use HasProvider, HasEphemeral, HasModel, HasNew;

    /**
     * @var string|null $externalId The external id of the image, returned by the provider
     */
    private ?string $externalId = null;

    /**
     * @var string|null $prompt The prompt of the image, provided by the user
     */
    private ?string $prompt = null;

    /**
     * @var int|null $width The width of the image, provided by the user
     */
    private ?int $width = null;

    /**
     * @var int|null $height The height of the image, provided by the user
     */
    private ?int $height = null;

    /**
     * @var string|null $url The url of the image, returned by the provider
     */
    private ?string $url = null;

    /**
     * @var Image|null $image The corresponding image model
     */
    private ?Image $image = null;

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
     * Setter for the prompt
     */
    public function withPrompt(string $prompt = null): self
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
     * Setter for the width
     */
    public function withWidth(int $width = null): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Getter for the width
     */
    public function width(): ?int
    {
        return $this->width;
    }

    /**
     * Setter for the height
     */
    public function withHeight(int $height = null): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Getter for the height
     */
    public function height(): ?int
    {
        return $this->height;
    }

    /**
     * Setter for the url
     */
    public function withUrl(string $url = null): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Getter for the url
     */
    public function url(): ?string
    {
        return $this->url;
    }

    /**
     * Setter for the image
     */
    public function withImage(Image $image): self
    {
        $this->image = $image;

        $this->withExternalId($image->external_id)
            ->withPrompt($image->prompt)
            ->withWidth($image->width)
            ->withHeight($image->height)
            ->withUrl($image->url);

        return $this;
    }

    /**
     * Getter for the image
     */
    public function image(): ?Image
    {
        return $this->image;
    }

    /**
     * Returns the array representation of the bridge
     */
    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'width'  => $this->width,
            'height' => $this->height,
            'url'    => $this->url
        ];
    }

    /**
     * Imports the bridge into the database
     */
    public function import(): Model
    {
        $this->image = $this->image ?? (new Image);
        $this->image->forceFill($this->toArray())->save();

        return $this->image;
    }

    /**
     * Saves the request into the database, with the corresponding token usage
     */
    public function saveRequest(TokenUsageResponse $tokenUsage): ApiRequest
    {
        $apiRequest              = ApiRequest::new()->fill($tokenUsage->toArray());
        $apiRequest->external_id = $this->externalId();

        if ($this->image()) {
            $apiRequest->requestable()->associate($this->image());
        }

        $apiRequest->save();
        return $apiRequest;
    }

    /**
     * Generates an image, using the AI provider
     */
    public function generate(string $prompt, int $width, int $height): string
    {
        /**
         * Get the response from the provider, in the ImageResponse format
         */
        $response = $this->provider()->getConnector()->imageGenerate($prompt, $width, $height);

        /**
         * Populate local data
         */
        $this->prompt = $prompt;
        $this->width  = $width;
        $this->height = $height;
        $this->url    = $response->url();

        /**
         * 1. Import into a model, if not ephemeral
         * 2. Save the request
         */
        if (!$this->isEphemeral()) {
            $this->import();
        }
        $this->saveRequest($response->tokenUsage());

        /**
         * Return the url
         */
        return $this->url;
    }
}
