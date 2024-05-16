<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Adapters\Persistence\Eloquent;

use Travle\Domain\Auth\Entity\User as UserEntity;
use Travle\Domain\Auth\Exception\RegisterFailed;
use Travle\Domain\Auth\Repository;
use Travle\Domain\Auth\ValueObjects\Token;
use Travle\Shared\Adapters\Persistence\Eloquent\Models\User;
use Throwable;

use function password_verify;

class AuthRepository implements Repository
{
    /**
     * Register a new user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function register(array $data): array
    {
        try {
            $user           = new User();
            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->password = $data['password'];
            $user->save();

            return (new UserEntity($user))->toArray($user);
        } catch (Throwable $e) {
            throw RegisterFailed::create('Failed to register user', ['error' => $e->getMessage()]);
        }
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
        try {
            $user = User::where('email', $data['email'])->first();

            if (! $user || ! password_verify($data['password'], $user->password)) {
                return ['message' => 'Invalid credentials'];
            }

            $token = $user->createToken('auth_token');

            if (! $token) {
                throw RegisterFailed::create('Failed to login user', ['error' => 'Failed to create token']);
            }

            return [
                'user' => (new UserEntity($user))->toArray($user),
                'auth' => (new Token($token->plainTextToken))->getToken(),
            ];
        } catch (Throwable $e) {
            throw RegisterFailed::create('Failed to login user', ['error' => $e->getMessage()]);
        }
    }
}
