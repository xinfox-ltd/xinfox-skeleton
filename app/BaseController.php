<?php
/**
 * 基础控制器
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox;

use think\App;
use think\Cache;
use think\Request;
use XinFox\Auth\Auth;
use XinFox\Auth\VisitorInterface;

abstract class BaseController
{
    protected App $app;

    protected Request $request;
    /**
     * @var object|Auth
     */
    protected Auth $auth;
    /**
     * @var object|VisitorInterface
     */
    protected VisitorInterface $visitor;

    /**
     * @var Cache
     */
    protected Cache $cache;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $app->request;
        $this->auth = $app->get(Auth::class);
        $this->visitor = $app->get(VisitorInterface::class);
        $this->cache = $app->cache;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
    }
}