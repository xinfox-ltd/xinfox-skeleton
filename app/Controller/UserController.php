<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;
use XinFox\Module\User\Application\UserBindWechatMiniProgram;

class UserController extends BaseController
{
    public function create()
    {

    }

    public function edit()
    {

    }

    public function updateStatus()
    {

    }

    /**
     * @Route("/v1/users/bind", method="POST")
     */
    public function bindWechatMiniProgram(): Json
    {
        $data = $this->request->post();

        $userBindWechatMiniProgram = new UserBindWechatMiniProgram();
        $userBindWechatMiniProgram->exec($this->visitor->getId(), $data['open_id'], $data['union_id'] ?? null);

        //TODO 自动登录？

        return success_response(null, '绑定成功');
    }
}