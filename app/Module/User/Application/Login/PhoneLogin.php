<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application\Login;

use XinFox\Module\User\Infrastructure\Exception\AccountNotExistException;
use XinFox\Module\User\Infrastructure\Exception\AccountOffException;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;

class PhoneLogin
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
     * @param $phone
     * @return User
     * @throws AccountNotExistException
     * @throws AccountOffException
     */
    public function exec($phone): User
    {
        $user = $this->userRepository->findFirstByPhone($phone);
        if (!$user) {
            throw new AccountNotExistException('账号不存在');
        }
        if (!$user->isNormal()) {
            throw new AccountOffException();
        }

        return $user;
    }
}