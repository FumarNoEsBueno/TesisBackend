<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'solicitar_transporte'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:4200',
        'https://api.biobioreciclajes.cl',
        'https://tesisdiego.biobioreciclajes.cl',
        'https://biobioreciclajes.cl',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
