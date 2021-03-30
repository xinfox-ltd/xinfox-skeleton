<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Validator;

use think\Validate;

class CaptchaValidator extends Validate
{
    protected array $rule = [
        'type' => 'require|in:image,sms',
    ];

    protected array $message = [
        'type.in' => '验证码类型[type]必须是 image 或者 sms',
    ];
}