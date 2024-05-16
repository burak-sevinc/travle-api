<?php

declare(strict_types=1);

namespace Travle\Shared\Exception;

class UserNotFound extends DomainException
{
    public const CODE   = 'shared/user-not-found';
    public const TITLE  = 'User not found';
    public const STATUS = 404;
    public const TYPE   = 'https://httpstatus.es/404';
}
