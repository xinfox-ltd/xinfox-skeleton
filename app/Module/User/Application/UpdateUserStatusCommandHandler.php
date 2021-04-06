<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application;

use XinFox\Module\User\Infrastructure\Exception\AccountNotExistException;
use XinFox\Module\User\Infrastructure\Exception\AccountStatusException;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;

class UpdateUserStatusCommandHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     * @throws AccountNotExistException|AccountStatusException
     */
    public function enable($userId)
    {
        $user = $this->getUser($userId);

        $user->enable();
        $this->userRepository->save($user);
    }

    /**
     * @param $userId
     * @throws AccountNotExistException|AccountStatusException
     */
    public function forbidden($userId)
    {
        $user = $this->getUser($userId);

        $user->forbidden();
        $this->userRepository->save($user);
    }

    /**
     * @param int $userId
     * @return User
     * @throws AccountNotExistException
     */
    protected function getUser(int $userId): User
    {
        $user = $this->userRepository->findFirstByUserId($userId);
        if (!$user) {
            throw new AccountNotExistException();
        }
        return $user;
    }
}