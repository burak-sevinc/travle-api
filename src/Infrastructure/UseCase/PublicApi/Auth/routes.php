<?php

declare(strict_types=1);

namespace Crackcode\Infrastructure\UseCase\PublicApi\Auth;

use Crackcode\Infrastructure\UseCase\PublicApi\Auth\Controllers\Login;
use Crackcode\Infrastructure\UseCase\PublicApi\Auth\Controllers\Register;
use Illuminate\Support\Facades\Route;

/**
 * Auth routes
 * These routes are compiled by the routes file in the parent directory and used in routes/api.php.
 */
Route::post('auth/register', Register::class);
Route::post('auth/login', Login::class);
