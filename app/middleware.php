<?php
/**
 * 全局中间件定义文件
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

return [
    // 全局请求缓存
//     \think\Middleware\CheckRequestCache::class,
    // 多语言加载
     \think\Middleware\LoadLangPack::class,
    // Session初始化
    // \think\Middleware\SessionInit::class
];
