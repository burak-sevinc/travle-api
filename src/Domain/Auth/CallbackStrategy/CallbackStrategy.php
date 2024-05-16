<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\CallbackStrategy;

interface CallbackStrategy
{
    /** @param array<string, mixed> $data */
    public function execute(array $data): void;
}
