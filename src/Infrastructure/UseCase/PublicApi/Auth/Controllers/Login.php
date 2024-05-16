<?php

declare(strict_types=1);

namespace Crackcode\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Crackcode\Domain\Auth\AuthService;
use Crackcode\Domain\Auth\Commands\LoginCommandPayload;
use Crackcode\Shared\Utils\JsonResponse;

class Login extends Controller
{
    public function __invoke(LoginCommandPayload $payload, AuthService $authService): JsonResponse
    {
        $payload = $payload->validated();
        $user    = $authService->login($payload);

        return JsonResponse::success($user, 'User logged in successfully');
    }
}
