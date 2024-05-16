<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Exception;

use Travle\Shared\Exception\DomainException;

class CallbackFailed extends DomainException
{
    public const CODE   = 'auth/callback-failed';
    public const TITLE  = 'Callback failed';
    public const STATUS = 500;
    public const TYPE   = 'https://httpstatus.es/500';
}
