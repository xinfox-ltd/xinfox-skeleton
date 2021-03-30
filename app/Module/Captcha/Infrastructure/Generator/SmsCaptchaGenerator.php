<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Generator;

use XinFox\Module\Captcha\Domain\Captcha;
use XinFox\Module\Captcha\Domain\CaptchaDrive;
use XinFox\Module\Captcha\Infrastructure\Sms\SceneInterface;
use XinFox\Sms\Exceptions\InvalidArgumentException;
use XinFox\Sms\XinFoxSms;

class SmsCaptchaGenerator implements CaptchaDrive
{
    private SceneInterface $scene;
    private XinFoxSms $foxSms;

    public function __construct(XinFoxSms $foxSms, SceneInterface $scene)
    {
        $this->scene = $scene;
        $this->foxSms = $foxSms;
    }

    /**
     * @return Captcha
     * @throws InvalidArgumentException
     */
    public function generate(): Captcha
    {
        $phoneNumber = $this->scene->getPhone();
        $this->foxSms->send($this->scene->getPhone(), $this->scene);

        return new Captcha('sms', $phoneNumber, $phoneNumber, $this->scene->getCaptcha());
    }
}