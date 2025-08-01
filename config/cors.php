<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'solicitar_transporte'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:4200',
        'http://192.168.1.85:4200',//para trabajar en local a traves del firewall
        'https://api.biobioreciclajes.cl',
        'https://materiales.biobioreciclajes.cl',
        'https://biobioreciclajes.cl',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
