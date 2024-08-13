<?php

    return [
        'paths' => ['api/*'],
        'allowed_methods' => ['*'],
        'allowed_origins' => ['http://localhost:8081'], // ваш фронтенд-URL
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['*'],
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => true, // Обратите внимание, что должно быть true
    ];
