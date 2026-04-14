<?php

return [

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:4200',
        'http://localhost:54142',
        'https://achocalla.gob.bo',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'Accept', 'Authorization', 'X-Portal-Key'],

    'exposed_headers' => ['X-Encrypted', 'X-RateLimit-Limit', 'X-RateLimit-Remaining', 'Retry-After'],

    'max_age' => 0,

    'supports_credentials' => false,

];
