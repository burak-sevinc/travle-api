<?php

declare(strict_types=1);

use Crackcode\Shared\Utils\JsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(static function (Middleware $middleware): void {
    })
    ->withExceptions(static function (Exceptions $exceptions): void {
        $exceptions->renderable(static function (Throwable $e) {
            return JsonResponse::error(['error' => $e->getMessage()]);
        });
    })->create();
