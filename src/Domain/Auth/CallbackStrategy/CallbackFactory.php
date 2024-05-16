<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\CallbackStrategy;

use InvalidArgumentException;
use Travle\Domain\Auth\ValueObjects\CallbackType;

class CallbackFactory
{
    public static function create(CallbackType $type): CallbackStrategy
    {
        return match ($type) {
            CallbackType::CREATED => new CreatedCallbackStrategy(),
            CallbackType::UPDATED => new UpdatedCallbackStrategy(),
            CallbackType::DELETED => new DeletedCallbackStrategy(),
            CallbackType::SESSION_CREATED => new SessionCreatedCallbackStrategy(),
            default => throw new InvalidArgumentException('Invalid callback type'),
        };
    }
}
