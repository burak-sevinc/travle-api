<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

use function count;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->descriptiveResponseMethods();
    }

    protected function descriptiveResponseMethods(): void
    {
        $instance = $this;
        Response::macro('ok', static function ($data = []) {
            return Response::json(['data' => $data], 200);
        });

        Response::macro('created', static function ($data = []) {
            if (count($data)) {
                return Response::json(['data' => $data], 201);
            }

            return Response::json([], 201);
        });

        Response::macro('noContent', static function ($data = []) {
            return Response::json([], 204);
        });

        Response::macro('badRequest', static function ($message = 'Validation Failure', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 400);
        });

        Response::macro('unauthorized', static function ($message = 'User unauthorized', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 401);
        });

        Response::macro('forbidden', static function ($message = 'Access denied', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 403);
        });

        Response::macro('notFound', static function ($message = 'Resource not found.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 404);
        });

        Response::macro(
            'internalServerError',
            static function ($message = 'Internal Server Error.', $errors = []) use ($instance) {
                return $instance->handleErrorResponse($message, $errors, 500);
            },
        );
    }

    /**
     * Handle error response
     *
     * @param array<string, mixed> $errors
     */
    public function handleErrorResponse(string $message, array $errors, int $status): JsonResponse
    {
        $response = ['message' => $message];

        if (count($errors)) {
            $response['errors'] = $errors;
        }

        return Response::json($response, $status);
    }
}
