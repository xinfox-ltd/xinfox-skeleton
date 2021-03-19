<?php
/**
 * Auth配置文件
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

return [
    'default' => [
        'guard' => 'jwt'
    ],
    'guards' => [
        'jwt' => [
            'provider' => \XinFox\Auth\Guard\JWTGuard::class,
            'base64_encoded' => '6a8sCpcvcykfrSM3vA0RZyKGtLe6vin8NZOGuwxYppc=',
        ]
    ],
    'providers' => [
        'user' => \XinFox\Provider\Component\Auth\UserProvider::class,
        'token' => \XinFox\Provider\Component\Auth\TokenProvider::class
    ]
];