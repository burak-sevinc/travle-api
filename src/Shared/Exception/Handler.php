<?php

declare(strict_types=1);

namespace Travle\Shared\Exception;

use Travle\Shared\Utils\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function report(Throwable $e): void
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render(Request $request, Throwable $e): \Illuminate\Http\JsonResponse|Response
    {
        if ($request->expectsJson()) {
            return JsonResponse::error(['error' => $e->getMessage()]);
        }

        return parent::render($request, $e);
    }
}
