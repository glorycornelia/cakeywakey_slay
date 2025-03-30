<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-7CQ9fxPtKYwDSLjZPlN_QEov'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-or26nL7s2P1Ut4zR'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,
];