<?php
/**
 * 当前文件功能说明
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Model;

use think\Model;
use XinFox\Auth\VisitorInterface;

class User extends Model
{
    const ROLES = [
        'admin' => 1,
        'buyer' => 2,
    ];

    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'created_at';

    protected $updateTime = 'updated_at';

    public function getRole(): string
    {
        return array_flip(self::ROLES)[$this->role];
    }

    public function getId(): int
    {
        return $this->id;
    }
}