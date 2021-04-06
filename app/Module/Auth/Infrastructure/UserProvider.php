<?php
/**
 * 当前文件功能说明
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Module\Auth\Infrastructure;

use XinFox\Auth\UserProviderInterface;
use XinFox\Auth\VisitorInterface;
use XinFox\Model\User;

class UserProvider implements UserProviderInterface
{
    public function loginById($uid): VisitorInterface
    {

    }
}