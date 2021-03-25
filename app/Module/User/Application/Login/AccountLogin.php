<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application\Login;

use XinFox\Module\User\Application\Exception\AccountNotExistException;
use XinFox\Module\User\Application\Exception\AccountOffException;
use XinFox\Module\User\Application\Exception\PasswdErrorException;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;

class AccountLogin
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $account
     * @param string $plaintext
     * @return User
     * @throws AccountNotExistException
     * @throws PasswdErrorException|AccountOffException
     */
    public function exec(string $account, string $plaintext): User
    {
        $user = $this->userRepository->findFirstByAccount($account);
        if (!$user) {
            throw new AccountNotExistException('账号不存在');
        }
        if (!$user->verifyPassword($plaintext)) {
            //TODO 记录密码错误次数
            throw new PasswdErrorException("密码校验失败");
        }

        if (!$user->isNormal()) {
            throw new AccountOffException();
        }

        return $user;
    }
}