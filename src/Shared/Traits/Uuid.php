<?php

declare(strict_types=1);

namespace Crackcode\Shared\Traits;

use Closure;
use Illuminate\Support\Str;

/** @method static creating(Closure $param) */
trait Uuid
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model): void {
            $model->uuid = (string) Str::uuid();
        });
    }
}
