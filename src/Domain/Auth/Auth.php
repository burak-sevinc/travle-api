<?php

declare(strict_types=1);

namespace Travle\Domain\Auth;

use function explode;

readonly class Auth implements AuthService
{
    public function __construct(
        private Repository $repository,
    ) {
    }

    /**
     * Register a new user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function register(array $data): array
    {
        $name         = explode('@', $data['email'])[0];
        $data['name'] = $name;

        return $this->repository->register($data);
    }

    /**
     * Login a user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function login(array $data): array
    {
        return $this->repository->login($data);
    }
}
