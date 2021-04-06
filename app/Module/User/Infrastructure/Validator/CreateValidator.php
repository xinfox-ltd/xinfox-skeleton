<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Validator;

use think\Validate;

class CreateValidator  extends Validate
{
    protected $rule = [
        'phone' => 'require|mobile',
        'password' => 'require|length:6,20',
        'role' => 'require|in:buyer,admin'
    ];

    protected $message = [
        'phone.require' => '手机号不能为空',
        'phone.mobile' => '不是正确的手机号',
        'password.length' => '密码长度必须是6-20个字符',
        'role.in' => '角色错误'
    ];
}