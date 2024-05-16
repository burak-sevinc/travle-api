<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\Exception;

use Travle\Shared\Exception\DomainException;

class UserUpdateFailed extends DomainException
{
    public const CODE   = 'auth/user-update-failed';
    public const TITLE  = 'User update failed';
    public const STATUS = 500;
    public const TYPE   = 'https://httpstatus.es/500';
}
