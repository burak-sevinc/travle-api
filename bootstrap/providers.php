<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\DomainServiceProvider;
use App\Providers\ResponseServiceProvider;
use App\Providers\TelescopeServiceProvider;

return [
    AppServiceProvider::class,
    DomainServiceProvider::class,
    ResponseServiceProvider::class,
    TelescopeServiceProvider::class,
];
