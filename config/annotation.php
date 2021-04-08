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
            'middleware' => \XinFox\Annotation\Annotator\Middleware::class
        ]
    ],
    'model'  => [
        'enable' => true,
    ],
    'ignore' => [],
    'store'  => null,//缓存store
];
