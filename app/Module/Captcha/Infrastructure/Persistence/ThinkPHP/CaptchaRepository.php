<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Persistence\ThinkPHP;

use think\Cache;
use XinFox\Module\Captcha\Domain\Captcha;

class CaptchaRepository implements \XinFox\Module\Captcha\Domain\CaptchaRepository
{
    private Cache $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function has($captchaId): bool
    {
        return $this->cache->has($captchaId);
    }

    public function get($captchaId): ?Captcha
    {
        return $this->cache->get($captchaId);
    }

    public function save(Captcha $captcha, int $ttl)
    {
        $this->cache->set($captcha->getId(), $captcha, $ttl);
    }
}