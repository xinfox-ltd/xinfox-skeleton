<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Exception;

use Throwable;
use XinFox\Module\User\Domain\WechatMiniProgramSession;

class NotBindException extends \Exception
{
    private WechatMiniProgramSession $miniProgramSession;

    public function __construct(
        WechatMiniProgramSession $miniProgramSession,
        $message = "没有绑定",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->miniProgramSession = $miniProgramSession;
    }

    public function getMiniProgramSession(): WechatMiniProgramSession
    {
        return $this->miniProgramSession;
    }
}