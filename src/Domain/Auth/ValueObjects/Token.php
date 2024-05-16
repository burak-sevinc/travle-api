<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\ValueObjects;

class Token
{
    /**
     * Token constructor
     */
    public function __construct(private readonly string $token)
    {
    }

    /**
     * Get the token
     *
     * @return array<string, string>
     */
    public function getToken(): array
    {
        return [
            'type' => 'Bearer',
            'token' => $this->token,
        ];
    }
}
