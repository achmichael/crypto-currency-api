<?php

return [
    // agar tidak terkena verifikasi csrf token
    'middleware' => [
        'verify_csrf_token' => \Laravel\Sanctum\Http\Middleware\VerifyCsrfToken::class,
    ],

    'except' => [
        'api/*',
        'items/*',
        'exchanges/*',
    ],

];