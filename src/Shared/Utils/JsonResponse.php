<?php

declare(strict_types=1);

namespace Travle\Shared\Utils;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponseHttp;

readonly class JsonResponse implements Responsable
{
    /** @param array<string, mixed> $data */
    public function __construct(
        public array $data,
        public int $status = 200,
        public array|string|null $message = null,
    ) {
    }

    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse(mixed $request): JsonResponseHttp
    {
        return new JsonResponseHttp(
            data: [
                'status' => $this->status,
                'data' => $this->data,
                'message' => $this->message ?? null,
            ],
            status: $this->status,
        );
    }

    /** @param array<string, mixed> $data */
    public static function success(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 200, $message);
    }

    /** @param array<string, mixed> $data */
    public static function error(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 400, $message);
    }

    /** @param array<string, mixed> $data */
    public static function notFound(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 404, $message);
    }

    /** @param array<string, mixed> $data */
    public static function noContent(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 204, $message);
    }

    /** @param array<string, mixed> $data */
    public static function created(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 201, $message);
    }

    /** @param array<string, mixed> $data */
    public static function unauthorized(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 401);
    }

    /** @param array<string, mixed> $data */
    public static function forbidden(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 403, $message);
    }

    /** @param array<string, mixed> $data */
    public static function internalServerError(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 500, $message);
    }

    /** @param array<string, mixed> $data */
    public static function badRequest(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 400, $message);
    }

    /** @param array<string, mixed> $data */
    public static function unprocessableEntity(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 422, $message);
    }

    /** @param array<string, mixed> $data */
    public static function conflict(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 409, $message);
    }

    /** @param array<string, mixed> $data */
    public static function tooManyRequests(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 429, $message);
    }

    /** @param array<string, mixed> $data */
    public static function serviceUnavailable(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 503, $message);
    }

    /** @param array<string, mixed> $data */
    public static function methodNotAllowed(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 405, $message);
    }

    /** @param array<string, mixed> $data */
    public static function gone(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 410, $message);
    }

    /** @param array<string, mixed> $data */
    public static function notImplemented(array $data, array|string|null $message = null): JsonResponse
    {
        return new JsonResponse($data, 501, $message);
    }
}
