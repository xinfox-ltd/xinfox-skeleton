<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Domain;

use XinFox\Auth\VisitorInterface;

class User implements VisitorInterface
{
    public const STATUS_ENABLE = 1;
    public const STATUS_DISALLOWED = 2;
    public const STATUS_CANCEL = 3;

    public const STATUS = [
        self::STATUS_ENABLE => '正常',
        self::STATUS_DISALLOWED => '停用',
        self::STATUS_CANCEL => '注销',
    ];

    protected int $id;

    protected string $passwd;

    protected string $role;

    protected int $status;

    /**
     * @var string|null
     */
    protected ?string $wechatMiniProgramOpenId;

    /**
     * @var string|null
     */
    protected ?string $wechatMiniProgramUnionId;

    public function __construct()
    {
    }

    public function verifyPassword(string $plaintext): bool
    {
        return password_verify($plaintext, $this->passwd);
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isNormal(): bool
    {
        return $this->status == self::STATUS_ENABLE;
    }

    public function bindWechatMiniProgram(WechatMiniProgramSession $session)
    {
        $this->wechatMiniProgramOpenId = $session->getOpenId();
        $this->wechatMiniProgramUnionId = $session->getUnionId();
    }
}