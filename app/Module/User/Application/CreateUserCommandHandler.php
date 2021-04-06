<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application;

use XinFox\Module\User\Infrastructure\Exception\AccountAlreadyExistException;
use XinFox\Module\User\Domain\User;
use XinFox\Module\User\Domain\UserRepository;

class CreateUserCommandHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CreateUserCommand $command
     * @return User
     * @throws AccountAlreadyExistException
     */
    public function create(CreateUserCommand $command): User
    {
        $user = $this->userRepository->findFirstByPhone($command->getPhone());
        if ($user) {
            throw new AccountAlreadyExistException();
        }
        $user = User::create(
            $command->getPhone(),
            $command->getPassword(),
            $command->getRole()
        );
        $this->userRepository->save($user);

        // TODO 事件推送

        return $user;
    }
}