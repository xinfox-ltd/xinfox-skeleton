<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Persistence\ThinkPHP;

use think\Model;
use XinFox\Module\User\Domain\User;

class UserRepository extends Model implements \XinFox\Module\User\Domain\UserRepository
{

    public function findFirstByUserId(int $userId): ?User
    {
        self::where('id', $userId)->find();
    }

    public function findFirstByAccount($account): ?User
    {
        // TODO: Implement findFirstByAccount() method.
    }

    public function findFirstByPhone($phone): ?User
    {
        // TODO: Implement findFirstByPhone() method.
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
        parent::save([]);
    }
}