<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Adapters\Persistence\Eloquent;

use Backendbase\Utility\Arrays\ArrayKeysCamelCaseConverter;
use DateTimeImmutable;
use Illuminate\Support\Facades\DB;
use Throwable;
use Travle\Domain\Auth\CallbackStrategy\CallbackFactory;
use Travle\Domain\Auth\Entity\User as UserEntity;
use Travle\Domain\Auth\Exception\CallbackFailed;
use Travle\Domain\Auth\Exception\InvalidRefreshToken;
use Travle\Domain\Auth\Exception\UserDeleteFailed;
use Travle\Domain\Auth\Exception\UserUpdateFailed;
use Travle\Domain\Auth\Repository;
use Travle\Domain\Auth\ValueObjects\CallbackType;
use Travle\Shared\Adapters\Persistence\Eloquent\Models\User;
use Travle\Shared\Exception\UserNotFound;

use function config;
use function json_encode;
use function now;

use const JSON_PRETTY_PRINT;
use const JSON_THROW_ON_ERROR;

class AuthRepository implements Repository
{
    /**
     * Create a user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function create(array $data): array
    {
        try {
            $meta        = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
            $user        = new User();
            $user->email = $data['email'];
            $user->uuid  = $data['id'];
            $user->meta  = $meta;
            $user->save();

            return (new UserEntity($user))->toArray($user);
        } catch (Throwable $e) {
            throw UserUpdateFailed::create('Failed to create user', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update a user
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function update(array $data): array
    {
        try {
            $user = User::where('email', $data['email'])->first();

            if (! $user) {
                throw UserNotFound::create('User not found', ['email' => $data['email']]);
            }

            $meta       = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
            $user->meta = $meta;
            $user->save();

            return (new UserEntity($user))->toArray($user);
        } catch (Throwable $e) {
            throw UserUpdateFailed::create('Failed to update user', ['error' => $e->getMessage()]);
        }
    }

    public function delete(string $uuid): void
    {
        try {
            $user = User::where('uuid', $uuid)->first();

            if (! $user) {
                throw UserNotFound::create('User not found', ['uuid' => $uuid]);
            }

            $user->delete();
        } catch (Throwable $e) {
            throw UserDeleteFailed::create($e->getMessage(), ['error' => $e->getMessage()]);
        }
    }

    /**
     * Callback from the Clerk API
     *
     * @param array<string, mixed> $data
     */
    public function callback(array $data): void
    {
        try {
            $type = $data['type'];
            $data = $data['data'];

            if (! isset($data['id'])) {
                throw CallbackFailed::create('Missing id in callback data');
            }

            $callbackType = CallbackType::from($type);
            $callback     = CallbackFactory::create($callbackType);

            $callback->execute($data);

            $user = $this->getUserByUuid($data['id']);

            if (! $user) {
                throw UserNotFound::create('User not found', ['uuid' => $data['id']]);
            }
        } catch (Throwable $e) {
            throw CallbackFailed::create($e->getMessage());
        }
    }

    /** @return array<string, mixed> */
    public function getUserById(int $id): array
    {
        $user = User::find($id);

        if (! $user) {
            throw UserNotFound::create('User not found', ['id' => $id]);
        }

        return (new UserEntity($user))->toArray($user);
    }

    /** @return array<string, mixed> */
    public function getUserByEmail(string $email): array
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            throw UserNotFound::create('User not found', ['email' => $email]);
        }

        return (new UserEntity($user))->toArray($user);
    }

    /** @return array<string, mixed> */
    public function getUserByToken(string $token): array
    {
        $user = User::where('remember_token', $token)->first();

        if (! $user) {
            throw UserNotFound::create('User not found', ['token' => $token]);
        }

        return (new UserEntity($user))->toArray($user);
    }

    /** @return array<string, mixed> */
    public function getUserByRefreshToken(string $refreshToken): array
    {
        $user = User::where('remember_token', $refreshToken)->first();

        if (! $user) {
            throw UserNotFound::create('User not found', ['refreshToken' => $refreshToken]);
        }

        return (new UserEntity($user))->toArray($user);
    }

    /** @return array<string, mixed> */
    public function getUserByUuid(string $uuid): array
    {
        $user = User::where('uuid', $uuid)->first();

        if (! $user) {
            throw UserNotFound::create('User not found', ['uuid' => $uuid]);
        }

        return (new UserEntity($user))->toArray($user);
    }

    /** @return array<string, mixed> */
    public function createToken(string $uuid, string $email): array
    {
        $user = User::where('uuid', $uuid)->where('email', $email)->first();

        if (! $user) {
            throw UserNotFound::create('User not found', ['uuid' => $uuid, 'email' => $email]);
        }

        $token        = $user->createToken('auth_token', ['*'], $this->calculateExpiration(config('sanctum.expiration')));
        $refreshToken = $user->createToken('refresh_token', ['*'], $this->calculateExpiration(config('sanctum.rt_expiration')));

        return [
            'user' => (new UserEntity($user))->toArray($user),
            'type' => 'Bearer',
            'token' => $token->plainTextToken,
            'refreshToken' => $refreshToken->plainTextToken,
        ];
    }

    /** @return array<string, mixed> */
    public function createTokenByRefreshToken(string $refreshToken): array
    {
        try {
            $getRefreshToken = DB::table('personal_access_tokens')
                ->where('token', $refreshToken)
                ->where('name', 'refresh_token')
                ->whereDate('expires_at', '>', now())
                ->first();

            if (! $getRefreshToken) {
                throw InvalidRefreshToken::create('Invalid refresh token', ['refreshToken' => $refreshToken]);
            }

            $getRefreshToken = ArrayKeysCamelCaseConverter::convertKeysAndPropertyNames($getRefreshToken);
            $user            = User::find($getRefreshToken->tokenableId);

            if (! $user) {
                throw UserNotFound::create('User not found', ['id' => $getRefreshToken->tokenableId]);
            }

            $token = $user->createToken('auth_token', ['*'], $this->calculateExpiration(config('sanctum.expiration')));

            return [
                'user' => (new UserEntity($user))->toArray($user),
                'type' => 'Bearer',
                'token' => $token->plainTextToken,
                'refreshToken' => $refreshToken,
            ];
        } catch (Throwable $e) {
            throw InvalidRefreshToken::create($e->getMessage(), ['error' => $e->getMessage()]);
        }
    }

    private function calculateExpiration(int $ttl): DateTimeImmutable
    {
        try {
            return new DateTimeImmutable('now + ' . $ttl . ' seconds');
        } catch (Throwable $e) {
            throw UserUpdateFailed::create($e->getMessage(), ['error' => $e->getMessage()]);
        }
    }
}
