<?php
/**
 * 默认控制器
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;

class Index
{
    public function index(): Json
    {
        return json(['Hello' => 'XinFox']);
    }
}