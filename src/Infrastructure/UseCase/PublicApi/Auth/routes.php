<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth;

use Illuminate\Support\Facades\Route;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\Login;
use Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers\Register;

/**
 * Auth routes
 * These routes are compiled by the routes file in the parent directory and used in routes/api.php.
 */
Route::post('auth/register', Register::class);
Route::post('auth/login', Login::class);
