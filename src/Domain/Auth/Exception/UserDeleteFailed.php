<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Exception;

use Travle\Shared\Exception\DomainException;

class UserDeleteFailed extends DomainException
{
    public const CODE   = 'auth/user-delete-failed';
    public const TITLE  = 'User delete failed';
    public const STATUS = 500;
    public const TYPE   = 'https://httpstatus.es/500';
}
