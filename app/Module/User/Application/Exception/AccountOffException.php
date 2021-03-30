<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Application\Exception;

use Throwable;

class AccountOffException extends \Exception
{
    public function __construct($message = "账户异常，禁止登录", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}