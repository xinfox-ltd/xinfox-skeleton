<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;
use XinFox\Module\User\Application\Exception\AccountNotExistException;
use XinFox\Module\User\Application\Exception\NotExistException;
use XinFox\Module\User\Application\UserBindWechatMiniProgramService;

class UsersController extends BaseController
{
    /**
     * @Route("/users", method="POST")
     */
    public function create()
    {

    }

    /**
     * 修改用户
     * @Route("/v1/users/:id", method="POST", roles={"admin", "seller"})
     */
    public function edit()
    {

    }

    /**
     * 修改用户状态
     * @Route("/v1/users/:id/status", method="POST", roles={"admin"})
     */
    public function updateStatus()
    {

    }

    /**
     * @Route("/v1/users/bind/mini-program", method="POST")
     * @throw AccountNotExistException|NotExistException
     */
    public function bindWechatMiniProgram(): Json
    {
        $data = $this->request->post();

        $userBindWechatMiniProgram = new UserBindWechatMiniProgramService();
        $userBindWechatMiniProgram->exec($this->visitor->getId(), $data['open_id'], $data['union_id'] ?? null);

        //TODO 自动登录？

        return success_response(null, '绑定成功');
    }
}