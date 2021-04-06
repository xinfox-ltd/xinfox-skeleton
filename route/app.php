<?php
/**
 * 路由设置
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

use think\facade\Route;

Route::post('/captcha/verify', 'Captcha/verify');
Route::post('/v1/users/:userId/status', 'Users/updateStatus');

