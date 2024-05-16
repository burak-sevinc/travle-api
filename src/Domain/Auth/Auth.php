<?php

declare(strict_types=1);

namespace Travle\Domain\Auth;

readonly class Auth implements AuthService
{
    public function __construct(
        private Repository $repository,
    ) {
    }

    /**
     * Callback from the Clerk API
     *
     * @param array<string, mixed> $data
     */
    public function callback(array $data): void
    {
        $this->repository->callback($data);
    }

    /** @return array<string, mixed> */
    public function getUserById(int $id): array
    {
        return $this->repository->getUserById($id);
    }

    /** @return array<string, mixed> */
    public function getUserByEmail(string $email): array
    {
        return $this->repository->getUserByEmail($email);
    }

    /** @return array<string, mixed> */
    public function getUserByToken(string $token): array
    {
        return $this->repository->getUserByToken($token);
    }

    /** @return array<string, mixed> */
    public function getUserByRefreshToken(string $refreshToken): array
    {
        return $this->repository->getUserByRefreshToken($refreshToken);
    }

    /** @return array<string, mixed> */
    public function getUserByUuid(string $uuid): array
    {
        return $this->repository->getUserByUuid($uuid);
    }

    /** @return array<string, mixed> */
    public function createToken(string $uuid, string $email): array
    {
        return $this->repository->createToken($uuid, $email);
    }

    /** @return array<string, mixed> */
    public function createTokenByRefreshToken(string $refreshToken): array
    {
        return $this->repository->createTokenByRefreshToken($refreshToken);
    }
}
