<?php

return [
    'db'        => [
        'prefix' => env('AI_DB_PREFIX', 'ai_'),
    ],
    'openai'    => [
        'api_key'             => env('AI_OPENAI_API_KEY', null),
        'default_max_tokens'  => env('AI_OPENAI_DEFAULT_MAX_TOKENS', 5),
        'default_temperature' => env('AI_OPENAI_DEFAULT_TEMPERATURE', 0.2),
    ],
    'interface' => [
        'enabled' => env('AI_INTERFACE_ENABLED', true),
        'auth'    => [
            'name'    => env('AI_INTERFACE_AUTH_NAME', 'laravel-ai'),
            'enabled' => env('AI_INTERFACE_AUTH_ENABLED', true),
            'disable' => [
                'email_verification' => env('AI_INTERFACE_AUTH_DISABLE_EMAIL_VERIFICATION', false),
                'registration'       => env('AI_INTERFACE_AUTH_DISABLE_REGISTRATION', false),
                'forgot_password'    => env('AI_INTERFACE_AUTH_DISABLE_FORGOT_PASSWORD', false),
                'user_profile'       => env('AI_INTERFACE_AUTH_DISABLE_USER_PROFILE', false),
            ]
        ],
    ]
];
