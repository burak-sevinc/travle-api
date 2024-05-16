<?php

declare(strict_types=1);

/**
 * Project needs public routes now, maybe future will need private routes.
 */
$rootDir      = dirname(__DIR__, 1);
$publicRoutes = glob($rootDir . '/src/Infrastructure/UseCase/PublicApi/routes.php', GLOB_NOSORT);

foreach ($publicRoutes as $route) {
    if (! file_exists($route)) {
        continue;
    }

    require $route;
}
