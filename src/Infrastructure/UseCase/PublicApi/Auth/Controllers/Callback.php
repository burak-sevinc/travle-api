<?php

declare(strict_types=1);

namespace Travle\Infrastructure\UseCase\PublicApi\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Travle\Domain\Auth\AuthService;

class Callback extends Controller
{
    public function __invoke(Request $request, AuthService $authService): void
    {
        $authService->callback($request->all());
    }
}
