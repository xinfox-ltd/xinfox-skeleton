<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Domain;

interface WechatMiniProgramSessionRepository
{
    public function save(WechatMiniProgramSession $miniProgramSession);

    public function findFirstByOpenId(string $openId): ?WechatMiniProgramSession;

    public function findFirstByUnionId(string $unionId): ?WechatMiniProgramSession;
}