<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Travle\Domain\Auth\AuthService;
use Travle\Domain\Auth\Commands\RegisterCommandPayload;
use Travle\Shared\Utils\JsonResponse;

class Register extends Controller
{
    public function __invoke(RegisterCommandPayload $payload, AuthService $authService): JsonResponse
    {
        $payload = $payload->validated();
        $authService->register($payload);

        $login = $authService->login($payload);

        return JsonResponse::success(
            $login,
            'User registered and logged in successfully',
        );
    }
}
