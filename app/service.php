<?php
/**
 * 系统服务定义文件
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

use XinFox\AppService;

// 服务在完成全局初始化之后执行
return [
    AppService::class,
    \XinFox\Annotation\Service::class,
    \XinFox\ThinkPHP\Auth\Service::class
];
