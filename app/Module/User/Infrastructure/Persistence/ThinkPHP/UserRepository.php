<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Persistence\ThinkPHP;

use XinFox\Module\User\Domain\User;

class UserRepository implements \XinFox\Module\User\Domain\UserRepository
{
    public function findFirstByUserId(int $userId): ?User
    {
        $userModel = \XinFox\Model\User::where('id', $userId)->find();
        if (!$userModel instanceof \XinFox\Model\User) {
            return null;
        }

        return new User(
            $userModel->getId(),
            $userModel->phone,
            $userModel->password,
            $userModel->getRole(),
            $userModel->status
        );
    }

    public function findFirstByAccount($account): ?User
    {
        $userModel = \XinFox\Model\User::where('phone', $account)->find();
        if (!$userModel instanceof \XinFox\Model\User) {
            return null;
        }

        return new User(
            $userModel->getId(),
            $userModel->phone,
            $userModel->password,
            $userModel->getRole(),
            $userModel->status
        );
    }

    public function findFirstByPhone($phone): ?User
    {
        $userModel = \XinFox\Model\User::where('phone', $phone)->find();
        if (!$userModel instanceof \XinFox\Model\User) {
            return null;
        }

        return new User(
            $userModel->getId(),
            $userModel->phone,
            $userModel->password,
            $userModel->getRole(),
            $userModel->status
        );
    }

    public function findFirstByUnionId(string $unionId): ?User
    {
        // TODO: Implement findFirstByUnionId() method.
    }

    public function findFirstByOpenId(string $getOpenId): ?User
    {
        // TODO: Implement findFirstByOpenId() method.
    }

    public function save(User $user)
    {
        $data = [
            'phone' => $user->getPhone(),
            'password' => $user->getPasswd(),
            'role' => \XinFox\Model\User::ROLES[$user->getRole()],
            'status' => $user->getStatus()
        ];
        if ($user->getId() > 0) {
            \XinFox\Model\User::update($data, ['id' => $user->getId()]);
        } else {
            \XinFox\Model\User::create($data);
        }
    }
}