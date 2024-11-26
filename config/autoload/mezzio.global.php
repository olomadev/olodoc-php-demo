<?php

declare(strict_types=1);

return [

    // Enable debugging; typically used to provide debugging information within templates.
    'debug'  => false,
    
    // authentication configuration
    'authentication' => [
        'tablename' => 'users',
        'username' => 'email',
        'password' => 'password',
        'form' => [
            'username' => 'username',
            'password' => 'password',
        ]
    ],
    //
    // hCaptcha configurations
    // 
    'hCaptcha' => [
        'siteKey' => '',
        'secret' => '',
    ],
    'cookie' => [
        'token' => 'owa_token',
        'user' => 'owa_user',
    ],
    'mezzio' => [
        // Provide templates for the error handling middleware to use when
        // generating responses.
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
    'translator' => [
        'available_languages' => ['en', 'tr'],
        'locale' => [
            'en', // default locale
            'tr'  // fallback locale
        ],
        'translation_file_patterns' => [
            [
                'type' => 'PhpArray',
                'base_dir' => PROJECT_ROOT . '/data/language',
                'pattern' => '%s/default.php'
            ],
        ],
    ],
];
