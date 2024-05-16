<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Travle\Domain\Auth\AuthService;
use Travle\Domain\Auth\Commands\LoginCommandPayload;
use Travle\Shared\Utils\JsonResponse;

class Login extends Controller
{
    public function __invoke(LoginCommandPayload $payload, AuthService $authService): JsonResponse
    {
        $payload = $payload->validated();
        $user    = $authService->login($payload);

        return JsonResponse::success($user, 'User logged in successfully');
    }
}
