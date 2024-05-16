<?php

declare(strict_types=1);

namespace Travle\Domain\Auth;

use Travle\Domain\Auth\Adapters\Persistence\Eloquent\AuthRepository;

class ServiceProvider
{
    /**
     * List of services to be registered in the container
     *
     * @var array<string, string>
     */
    public static array $services = [
        Repository::class => AuthRepository::class,
        AuthService::class => Auth::class,
    ];

    /**
     * Get the list of services
     *
     * @return array<string, string>
     */
    public static function getServices(): array
    {
        return self::$services;
    }
}
