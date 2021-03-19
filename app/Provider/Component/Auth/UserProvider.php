<?php
/**
 * 当前文件功能说明
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Provider\Component\Auth;

use XinFox\User;
use XinFox\Auth\UserProviderInterface;
use XinFox\Auth\VisitorInterface;

class UserProvider implements UserProviderInterface
{
    public function loginById($uid): VisitorInterface
    {
        return new User();
    }
}