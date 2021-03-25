<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha;

use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

abstract class Generator implements CaptchaGeneratorInterface
{
    protected CacheInterface $cache;

    abstract protected function createCaptcha(): Captcha;

    public function __construct(CacheInterface $cache)
    {
        $this->setCache($cache);
    }

    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return Captcha
     * @throws InvalidArgumentException
     */
    public function create(): Captcha
    {
        $captcha = $this->createCaptcha();
        $this->cache->set($captcha->getId(), $captcha->getCode(), 600);

        return $captcha;
    }
}