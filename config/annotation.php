<?php

return [
    'inject' => [
        'enable'     => true,
        'namespaces' => ["XinFox"],
    ],
    'route'  => [
        'enable'      => true,
        'controllers' => [],
        'auth' => [
            'enable' => true,
            'middleware' => \XinFox\ThinkPHP\Auth\Middleware::class
        ]
    ],
    'model'  => [
        'enable' => true,
    ],
    'ignore' => [],
    'store'  => null,//缓存store
];
