<?php

namespace Illegal\LaravelAI\Responses;

use Illegal\LaravelUtils\Contracts\HasNew;

/**
 * This is the common message response to which all responses, from providers, are converted
 */
class MessageResponse
{
    use HasNew;

    /**
     * @var string $role - The role of the user sending the message
     */
    private string $role;

    /**
     * @var string $content - The content of the message
     */
    private string $content;

    /**
     * Setter for the role
     */
    public function withRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Getter for the role
     */
    public function role(): string
    {
        return $this->role;
    }

    /**
     * Setter for the content
     */
    public function withContent(string $content): self
    {
        /**
         * Trim the content, to remove any leading or trailing whitespace
         */
        $this->content = trim($content);
        return $this;
    }

    /**
     * Getter for the content
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * This method converts the message to an array
     *
     * @return array The array representation of the response
     */
    public function toArray(): array
    {
        return [
            'role'    => $this->role,
            'content' => $this->content,
        ];
    }
}
