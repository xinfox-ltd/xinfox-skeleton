<?php
/**
 * 路由设置
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

use think\facade\Route;

Route::get(
    '/',
    function () {
        return 'hello,ThinkPHP6!';
    }
);

Route::get('hello/:name', 'index/hello');
