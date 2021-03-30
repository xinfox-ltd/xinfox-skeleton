<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Domain;

interface CaptchaRepository
{
    public function has($captchaId): bool;

    public function get($captchaId): ?Captcha;

    public function save(Captcha $captcha, int $ttl);
}