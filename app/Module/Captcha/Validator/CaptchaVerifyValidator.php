<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Validator;

use think\Validate;

class CaptchaVerifyValidator extends Validate
{
    protected array $rule =   [
        'id'  => 'require',
        'code' => 'require'
    ];
}