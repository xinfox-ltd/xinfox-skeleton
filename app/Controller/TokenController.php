<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use XinFox\Annotation\Route;
use XinFox\BaseController;

class TokenController extends BaseController
{
    /**
     * 登录获取token
     * @Route("/v1/tokens", method="POST")
     */
    public function create()
    {
        var_dump($this->request->post());
    }
}