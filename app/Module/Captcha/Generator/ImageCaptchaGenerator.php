<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\Captcha\Generator;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Ramsey\Uuid\Uuid;
use XinFox\Module\Captcha\Captcha;
use XinFox\Module\Captcha\Generator;

class ImageCaptchaGenerator extends Generator
{
    public function createCaptcha(): Captcha
    {
        $builder = new CaptchaBuilder(null, new PhraseBuilder(4));
        $builder->build();

        $id = Uuid::uuid4()->toString();

        return new Captcha('image', $id, $builder->inline(), $builder->getPhrase());
    }
}