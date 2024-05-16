<?php

declare(strict_types=1);

namespace Travle\Shared\Utils;

use Illuminate\Support\Facades\Config;

class AuthConfig
{
    public function __construct(
        private int|null $passwordMin = null,
        private int|null $passwordMax = null,
        private int|null $emailMin = null,
        private int|null $emailMax = null,
    ) {
        $authConfig = Config::get('travle.auth');

        $passwordMin = $authConfig['auth']['password']['min'];
        $passwordMax = $authConfig['auth']['password']['max'];
        $emailMin    = $authConfig['auth']['email']['min'];
        $emailMax    = $authConfig['auth']['email']['max'];

        $this->passwordMin = $passwordMin;
        $this->passwordMax = $passwordMax;
        $this->emailMin    = $emailMin;
        $this->emailMax    = $emailMax;
    }

    public static function make(): self
    {
        return new self();
    }

    public function getPasswordMin(): int
    {
        return $this->passwordMin;
    }

    public function getPasswordMax(): int
    {
        return $this->passwordMax;
    }

    public function getEmailMin(): int
    {
        return $this->emailMin;
    }

    public function getEmailMax(): int
    {
        return $this->emailMax;
    }

    public function getAuthConfig(): array
    {
        return [
            'passwordMin' => $this->passwordMin,
            'passwordMax' => $this->passwordMax,
            'emailMin' => $this->emailMin,
            'emailMax' => $this->emailMax,
        ];
    }
}
