<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Generator;

use Psr\SimpleCache\CacheInterface;
use XinFox\Module\Captcha\Captcha;
use XinFox\Module\Captcha\Generator;
use XinFox\Module\Captcha\Sms\SceneInterface;
use XinFox\Sms\Exceptions\InvalidArgumentException;
use XinFox\Sms\XinFoxSms;

class SmsCaptchaGenerator extends Generator
{
    private SceneInterface $scene;
    private XinFoxSms $foxSms;

    public function __construct(CacheInterface $cache, XinFoxSms $foxSms, SceneInterface $scene)
    {
        parent::__construct($cache);
        $this->scene = $scene;
        $this->foxSms = $foxSms;
    }

    /**
     * @return Captcha
     * @throws InvalidArgumentException
     */
    public function createCaptcha(): Captcha
    {
        $phoneNumber = $this->scene->getPhone();
        $this->foxSms->send($this->scene->getPhone(), $this->scene);

        return new Captcha('sms', $phoneNumber, $phoneNumber, $this->scene->getCaptcha());
    }

    protected function getType(): string
    {
        return 'sms';
    }

    protected function getId(): string
    {
        return (string)$this->scene->getPhone();
    }

    protected function getSrc(): string
    {
        return (string)$this->scene->getPhone();
    }

    protected function getCode()
    {
        return (string)$this->scene->getCaptcha();
    }
}