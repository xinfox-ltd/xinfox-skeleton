<?php
/**
 * 当前文件功能说明
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox;

use XinFox\Auth\VisitorInterface;

class User implements VisitorInterface
{
    public function getRole(): string
    {
        return "seller";
    }

    public function getId()
    {
        return 1;
    }
}