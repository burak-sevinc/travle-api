<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Exception;

use Travle\Shared\Exception\DomainException;

class InvalidRefreshToken extends DomainException
{
    public const CODE   = 'auth/invalid-refresh-token';
    public const TITLE  = 'Invalid refresh token';
    public const STATUS = 400;
    public const TYPE   = 'https://httpstatus.es/400';
}
