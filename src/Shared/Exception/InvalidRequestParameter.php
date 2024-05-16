<?php

declare(strict_types=1);

namespace Travle\Shared\Exception;

class InvalidRequestParameter extends DomainException
{
    public const CODE   = 'request/invalid-parameter';
    public const TITLE  = 'Required parameter is invalid';
    public const STATUS = 400;
    public const TYPE   = 'https://httpstatus.es/400';
}
