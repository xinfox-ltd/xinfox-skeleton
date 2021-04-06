<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Exception;

use Throwable;

class AccountAlreadyExistException extends \Exception
{
    public function __construct($message = "账号已存在", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}