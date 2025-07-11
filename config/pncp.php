<?php

return [
    'envio' => [
        'base_url' => env('PNCP_BASE_URL', 'https://treina.pncp.gov.br/pncp-api'),
        'login' => env('PNCP_LOGIN'),
        'password' => env('PNCP_PASSWORD'),
        'login_endpoint' => env('PNCP_LOGIN_ENDPOINT', '/v1/usuarios/login'),
    ],

    'consulta' => [
        'base_url' => env('PNCP_CONSULTA_BASE_URL', 'https://treina.pncp.gov.br/pncp-consulta'),
    ]
];
