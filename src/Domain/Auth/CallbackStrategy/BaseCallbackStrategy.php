<?php

declare(strict_types=1);

namespace Travle\Domain\Auth\CallbackStrategy;

use Illuminate\Support\Facades\App;
use Travle\Domain\Auth\Adapters\Persistence\Eloquent\AuthRepository;

abstract class BaseCallbackStrategy
{
    protected AuthRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(AuthRepository::class);
    }
}
