<?php

declare(strict_types=1);

namespace Crackcode\Infrastructure\UseCase\PublicApi;

use function dirname;
use function file_exists;
use function glob;

use const GLOB_NOSORT;

/**
 * Public API routes
 * These routes are used in routes/api.php.
 */
$root   = __DIR__;
$routes = glob(dirname($root) . '/PublicApi/*/routes.php', GLOB_NOSORT);

foreach ($routes as $route) {
    if (! file_exists($route)) {
        continue;
    }

    require $route;
}
