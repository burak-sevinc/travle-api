<?php

declare(strict_types=1);

namespace Crackcode\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Crackcode\Domain\Auth\AuthService;
use Crackcode\Domain\Auth\Commands\RegisterCommandPayload;
use Crackcode\Shared\Utils\JsonResponse;

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
