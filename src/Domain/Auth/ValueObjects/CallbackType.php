<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\ValueObjects;

enum CallbackType: string
{
    case CREATED         = 'user.created';
    case UPDATED         = 'user.updated';
    case DELETED         = 'user.deleted';
    case SESSION_CREATED = 'session.created';
}
