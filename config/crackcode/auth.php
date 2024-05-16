<?php

declare(strict_types=1);

return [
    'auth' => [
        'email' => [
            'min' => 3,
            'max' => 255,
        ],
        'password' => [
            'min' => 8,
            'max' => 255,
        ],
    ],
];
