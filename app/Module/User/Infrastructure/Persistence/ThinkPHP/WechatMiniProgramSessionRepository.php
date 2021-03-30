<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Persistence\ThinkPHP;


use XinFox\Module\User\Domain\WechatMiniProgramSession;

class WechatMiniProgramSessionRepository implements \XinFox\Module\User\Domain\WechatMiniProgramSessionRepository
{

    public function save(WechatMiniProgramSession $miniProgramSession)
    {
        // TODO: Implement save() method.
    }

    public function findFirstByOpenId(string $openId): ?WechatMiniProgramSession
    {
        // TODO: Implement findFirstByOpenId() method.
    }

    public function findFirstByUnionId(string $unionId): ?WechatMiniProgramSession
    {
        // TODO: Implement findFirstByUnionId() method.
    }
}