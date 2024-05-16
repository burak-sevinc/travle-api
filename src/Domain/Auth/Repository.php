<?php

declare(strict_types=1);

namespace Travle\Domain\Auth;

interface Repository
{
    /**
     * Update a user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function update(array $data): array;

    public function delete(string $uuid): void;

    /**
     * Callback from the Clerk API
     *
     * @param array<string, mixed> $data
     */
    public function callback(array $data): void;

    /** @return array<string, mixed> */
    public function getUserById(int $id): array;

    /** @return array<string, mixed> */
    public function getUserByEmail(string $email): array;

    /** @return array<string, mixed> */
    public function getUserByToken(string $token): array;

    /** @return array<string, mixed> */
    public function getUserByRefreshToken(string $refreshToken): array;

    /** @return array<string, mixed> */
    public function getUserByUuid(string $uuid): array;

    /** @return array<string, mixed> */
    public function createToken(string $uuid, string $email): array;

    /** @return array<string, mixed> */
    public function createTokenByRefreshToken(string $refreshToken): array;
}
