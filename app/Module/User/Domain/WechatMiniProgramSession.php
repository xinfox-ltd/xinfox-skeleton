<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Domain;

/**
 * Class WechatMiniProgramSession
 * @package XinFox\Module\User\Domain
 */
class WechatMiniProgramSession
{
    private string $openId;

    private string $sessionKey;

    private ?string $unionId;

    public function __construct(string $openId, string $sessionKey, string $unionId = null)
    {
        $this->openId = $openId;
        $this->sessionKey = $sessionKey;
        $this->unionId = $unionId;
    }

    /**
     * @return string
     */
    public function getOpenId(): string
    {
        return $this->openId;
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }

    /**
     * @return string|null
     */
    public function getUnionId(): ?string
    {
        return $this->unionId;
    }
}