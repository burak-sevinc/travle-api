<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth;

use Illuminate\Support\Facades\Route;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\Callback;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\CreateToken;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\Deneme;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\RefreshToken;

/**
 * Auth routes
 * These routes are compiled by the routes file in the parent directory and used in routes/api.php.
 */
Route::post('auth/callback', Callback::class);
Route::post('auth/token', CreateToken::class);
Route::post('auth/refresh-token', RefreshToken::class);
