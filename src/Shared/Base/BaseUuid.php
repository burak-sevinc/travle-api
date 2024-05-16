<?php

declare(strict_types=1);

namespace Crackcode\Shared\Base;

use Ramsey\Uuid\Uuid;

abstract class BaseUuid
{
    public function __construct(protected string $value)
    {
    }

    public static function generate(): self
    {
        return new static(Uuid::uuid4()->toString());
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }
}
