<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Domain;

use XinFox\Auth\VisitorInterface;
use XinFox\Module\User\Infrastructure\Exception\AccountStatusException;

class User implements VisitorInterface
{
    public const STATUS_ENABLE = 1;
    public const STATUS_FORBIDDEN = -1;
    public const STATUS_CANCEL = -10;

    public const STATUS = [
        self::STATUS_ENABLE => '正常',
        self::STATUS_FORBIDDEN => '停用',
        self::STATUS_CANCEL => '注销',
    ];

    protected ?int $id;

    protected ?OpenId $openId;

    protected $phone;

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

    public function __construct(?int $id, $phone, $passwd, $role, int $status, OpenId $openId = null)
    {
        $this->setId($id);
        $this->setPhone($phone);
        $this->setPasswd($passwd);
        $this->setRole($role);
        $this->setStatus($status);
        if ($openId) {
            $this->setOpenId($openId);
        }
    }

    /**
     * @param $phone
     * @param $password
     * @param $role
     * @return static
     */
    public static function create($phone, $password, $role): self
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        // 默认新注册用户是正常状态
        $self = new self(null, $phone, $password, $role, self::STATUS_ENABLE);

        // TODO 事件

        return $self;
    }

    public function verifyPassword(string $plaintext): bool
    {
        return password_verify($plaintext, $this->passwd);
    }

    /**
     * @param ?int $id
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setOpenId(OpenId $openId)
    {
        $this->openId = $openId;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $role
     */
    private function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @param int $status
     */
    private function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param string $passwd
     */
    private function setPasswd(string $passwd): void
    {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPasswd(): string
    {
        return $this->passwd;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return OpenId|null
     */
    public function getOpenId(): ?OpenId
    {
        return $this->openId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function isNormal(): bool
    {
        return $this->status == self::STATUS_ENABLE;
    }

    public function isForbidden(): bool
    {
        return $this->status == self::STATUS_FORBIDDEN;
    }

    public function bindWechatMiniProgram(WechatMiniProgramSession $session)
    {
        $this->wechatMiniProgramOpenId = $session->getOpenId();
        $this->wechatMiniProgramUnionId = $session->getUnionId();
    }

    /**
     * @throws AccountStatusException
     */
    public function enable()
    {
        if ($this->isNormal()) {
            throw new AccountStatusException();
        }
        $this->status = self::STATUS_ENABLE;
    }

    /**
     * @throws AccountStatusException
     */
    public function forbidden()
    {
        if ($this->isForbidden()) {
            throw new AccountStatusException();
        }
        $this->status = self::STATUS_FORBIDDEN;
    }
}