<?php
/**
 * 应用服务类
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox;

use think\Service;
use XinFox\Sms\XinFoxSms;

/**
 * 应用服务类
 */
class AppService extends Service
{
    public function register()
    {
        $config = $this->app->config->get('sms');
        $this->app->bind(
            XinFoxSms::class,
            fn() => new XinFoxSms($config)
        );
    }

    /**
     */
    public function boot()
    {

    }
}
