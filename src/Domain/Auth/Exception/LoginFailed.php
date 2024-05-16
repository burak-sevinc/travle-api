<?php

declare(strict_types=1);

namespace Crackcode\Domain\Auth\Exception;

use Crackcode\Shared\Exception\DomainException;

class LoginFailed extends DomainException
{
    public const CODE   = 'auth/register-failed';
    public const TITLE  = 'Register failed';
    public const STATUS = 400;
    public const TYPE   = 'https://httpstatus.es/400';
}
