<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Sms;

use XinFox\Sms\Contracts\MessageInterface;

interface SceneInterface extends MessageInterface
{
    public function getPhone();

    public function getCaptcha();
}