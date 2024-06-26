<?php

declare(strict_types=1);

namespace Travle\Shared\Base;

abstract class BaseIntegerId
{
    public function __construct(private readonly int $id)
    {
    }

    public function id(): int
    {
        return $this->id;
    }
}
