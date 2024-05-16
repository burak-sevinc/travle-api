<?php

declare(strict_types=1);

namespace Crackcode\Shared\Exception;

use Crackcode\Shared\Application\CommonProblemDetailsException;
use DomainException as PhpDomainException;

/** @phpstan-consistent-constructor */
abstract class DomainException extends PhpDomainException implements ProblemDetailsException
{
    use CommonProblemDetailsException;

    public const STATUS = 500;
    public const TYPE   = 'https://httpstatus.es/500';
    public const CODE   = 'server/server-error';
    public const TITLE  = 'Server Error';

    /** @param array<string, mixed> $additional */
    private function __construct(int $status, string $detail, string $title, string $type, array $additional)
    {
        $this->status     = $status;
        $this->detail     = $detail;
        $this->title      = $title;
        $this->type       = $type;
        $this->additional = $additional;

        parent::__construct($detail, $status);
    }
}
