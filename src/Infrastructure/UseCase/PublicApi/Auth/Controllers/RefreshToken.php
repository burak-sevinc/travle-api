<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Travle\Domain\Auth\AuthService;

use function response;

class RefreshToken extends Controller
{
    public function __invoke(Request $request, AuthService $authService): JsonResponse
    {
        try {
            $validated = Validator::make($request->all(), ['refreshToken' => 'required|string']);

            if ($validated->fails()) {
                return response()->json([
                    'error' => 'Invalid input',
                    'details' => $validated->errors()->toArray(),
                ], 400);
            }

            $validated = $validated->validated();

            $user = $authService->createTokenByRefreshToken(
                refreshToken: $validated['refreshToken'],
            );
        } catch (Throwable $e) {
            return response()->json([
                'error' => 'An error occurred',
                'details' => $e->getMessage(),
            ], 500);
        }

        return response()->json($user);
    }
}
