<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Domain;

interface UserRepository
{
    public function findFirstByUserId(int $userId): ?User;

    public function findFirstByAccount($account): ?User;

    public function findFirstByPhone($phone): ?User;

    public function findFirstByUnionId(string $unionId): ?User;

    public function findFirstByOpenId(string $getOpenId): ?User;

    public function save(User $user);
}