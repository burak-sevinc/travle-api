<?php

declare(strict_types=1);

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', static function (): JsonResponse {
    return response()->json([
        'version' => '1.0.0',
        'name' => 'Travle API',
        'health' => 'ok',
    ]);
});
