<?php

declare(strict_types=1);

namespace Travle\Domain\Auth;

interface AuthService
{
    /**
     * Register a new user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function register(array $data): array;

    /**
     * Login a user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function login(array $data): array;
}
