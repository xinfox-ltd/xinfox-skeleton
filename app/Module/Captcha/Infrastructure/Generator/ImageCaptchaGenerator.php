<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Infrastructure\Generator;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Ramsey\Uuid\Uuid;
use XinFox\Module\Captcha\Domain\Captcha;
use XinFox\Module\Captcha\Domain\CaptchaDrive;

class ImageCaptchaGenerator implements CaptchaDrive
{
    private int $length;

    public function __construct($length = 4)
    {
        $this->length = $length;
    }

    public function generate(): Captcha
    {
        $builder = new CaptchaBuilder(null, new PhraseBuilder($this->length));
        $builder->build();

        $id = Uuid::uuid4()->toString();

        return new Captcha('image', $id, $builder->inline(), $builder->getPhrase());
    }
}