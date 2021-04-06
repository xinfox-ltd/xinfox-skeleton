<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;
use XinFox\Module\User\Application\CreateUserCommand;
use XinFox\Module\User\Application\CreateUserCommandHandler;
use XinFox\Module\User\Application\BindWechatMiniProgramService;
use XinFox\Module\User\Application\UpdateUserStatusCommandHandler;
use XinFox\Module\User\Infrastructure\Exception\AccountNotExistException;
use XinFox\Module\User\Infrastructure\Exception\AccountStatusException;
use XinFox\Module\User\Infrastructure\Persistence\ThinkPHP\UserRepository;
use XinFox\Module\User\Infrastructure\Validator\CreateValidator;

class UsersController extends BaseController
{
    /**
     * @Route("/v1/users", method="POST")
     */
    public function create(): Json
    {
        $data = $this->request->post();
        validate(CreateValidator::class)->check($data);

        $service = new CreateUserCommandHandler(
            new UserRepository()
        );
        $createUserCommand = new CreateUserCommand(
            $this->request->post('phone'),
            $this->request->post('password'),
            'buyer'
        );
        $service->create($createUserCommand);

        return success_response();
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
     * @param int $userId
     * @throws AccountNotExistException
     * @throws AccountStatusException
     */
    public function updateStatus(int $userId)
    {
        $data = $this->request->post();

        $commandHandler = new UpdateUserStatusCommandHandler(new UserRepository());
        if ($data['status'] == 1) {
            $commandHandler->enable($userId);
        } elseif ($data['status'] == -1) {
            $commandHandler->forbidden($userId);
        }
    }

    /**
     * @Route("/v1/users/bind/mini-program", method="POST")
     */
    public function bindWechatMiniProgram(): Json
    {
        $data = $this->request->post();

        $userBindWechatMiniProgram = new BindWechatMiniProgramService();
        $userBindWechatMiniProgram->exec($this->visitor->getId(), $data['open_id'], $data['union_id'] ?? null);

        //TODO 自动登录？

        return success_response(null, '绑定成功');
    }
}