<?php

declare(strict_types=1);

namespace Travle\Shared\Exception;

use JsonSerializable;
use Throwable;

interface ProblemDetailsException extends JsonSerializable, Throwable
{
    public static function create(string $details, array|null $additional = []): static;

    public function getStatus(): int;

    public function getType(): string;

    public function getTitle(): string;

    public function getDetail(): string;

    /** @return array<string, mixed> */
    public function getAdditionalData(): iterable;

    /** @return array<string, mixed> */
    public function toArray(): iterable;
}
