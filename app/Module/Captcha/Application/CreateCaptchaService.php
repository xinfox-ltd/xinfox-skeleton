<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Application;

use XinFox\Module\Captcha\Domain\Captcha;
use XinFox\Module\Captcha\Domain\CaptchaDrive;
use XinFox\Module\Captcha\Domain\CaptchaRepository;

class CreateCaptchaService
{
    protected CaptchaRepository $captchaRepository;

    protected CaptchaDrive $captchaDrive;

    public function __construct(CaptchaRepository $captchaRepository, CaptchaDrive $captchaDrive)
    {
        $this->setCaptchaRepository($captchaRepository);
        $this->captchaDrive = $captchaDrive;
    }

    public function setCaptchaRepository(CaptchaRepository $captchaRepository)
    {
        $this->captchaRepository = $captchaRepository;
    }

    /**
     * @param int $ttl 有效时间（秒）
     * @return Captcha
     */
    public function exec($ttl = 60): Captcha
    {
        $captcha = $this->captchaDrive->generate();
        $this->captchaRepository->save($captcha, $ttl);

        return $captcha;
    }
}