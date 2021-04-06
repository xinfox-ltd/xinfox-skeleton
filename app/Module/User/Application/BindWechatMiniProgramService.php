<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application;

use XinFox\Module\User\Infrastructure\Exception\AccountNotExistException;
use XinFox\Module\User\Infrastructure\Exception\NotExistException;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;
use XinFox\Module\User\Domain\WechatMiniProgramSessionRepository;

class BindWechatMiniProgramService
{
    private UserRepository $useRepository;

    private WechatMiniProgramSessionRepository $wechatMiniProgramSessionRepository;

    public function __construct(UserRepository $useRepository)
    {
        $this->useRepository = $useRepository;
    }

    /**
     * @param int $userId
     * @param string $openId
     * @param string|null $unionId
     * @return User
     * @throws AccountNotExistException
     * @throws NotExistException
     */
    public function exec(int $userId, string $openId, string $unionId = null): User
    {
        $user = $this->useRepository->findFirstByUserId($userId);
        if (!$user) {
            throw new AccountNotExistException();
        }

        $session = $this->wechatMiniProgramSessionRepository->findFirstByOpenId($openId);
        if (!$session && $unionId) {
            $session = $this->wechatMiniProgramSessionRepository->findFirstByUnionId($unionId);
        }

        if (!$session) {
            throw new NotExistException('找不到小程序授权登录信息');
        }

        $user->bindWechatMiniProgram($session);
        $this->useRepository->save($user);

        return $user;
    }
}