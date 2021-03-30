<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Application;

use XinFox\Module\Captcha\Domain\CaptchaRepository;

class CaptchaVerifyService
{
    private CaptchaRepository $captchaRepository;

    public function __construct(CaptchaRepository $captchaRepository)
    {
        $this->captchaRepository = $captchaRepository;
    }

    public function exec($captchaId, $code): bool
    {
        return $this->captchaRepository->has($captchaId)
            && $this->captchaRepository->get($captchaId)->getCode() == $code;
    }
}