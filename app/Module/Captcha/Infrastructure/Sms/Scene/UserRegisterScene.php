<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Sms\Scene;

use XinFox\Module\Captcha\Infrastructure\Sms\SceneInterface;
use XinFox\Sms\Contracts\GatewayInterface;

class UserRegisterScene implements SceneInterface
{
    private $phone;
    private int $code;

    public function __construct($phone)
    {
        //TODO 检测手机号是否注册

        $this->phone = $phone;
        $this->code = mt_rand(100000, 999999);
    }


    public function getData(GatewayInterface $gateway): array
    {
        return [
            'name' => "小艾"
        ];
    }

    public function getContent(GatewayInterface $gateway): string
    {
        // TODO: Implement getContent() method.
    }

    public function getTemplate(GatewayInterface $gateway): string
    {
        return 'SMS_205139885';
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getCaptcha()
    {
        return $this->code;
    }
}