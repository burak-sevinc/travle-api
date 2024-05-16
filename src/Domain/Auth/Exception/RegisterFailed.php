<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Exception;

use Travle\Shared\Exception\DomainException;

class RegisterFailed extends DomainException
{
    public const CODE   = 'auth/register-failed';
    public const TITLE  = 'Register failed';
    public const STATUS = 500;
    public const TYPE   = 'https://httpstatus.es/500';
}
