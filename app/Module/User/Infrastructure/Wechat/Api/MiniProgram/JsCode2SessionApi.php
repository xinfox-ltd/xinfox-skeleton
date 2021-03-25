<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Wechat\Api\MiniProgram;

use XinFox\Module\User\Infrastructure\Wechat\ApiInterface;
use XinFox\Module\User\Infrastructure\Wechat\Component;

class JsCode2SessionApi implements ApiInterface
{
    protected ?Component $component;

    protected $code;

    public function __construct($code, Component $component = null)
    {
        $this->component = $component;
        $this->code = $code;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return $this->component ? '/sns/component/jscode2session' : '/sns/jscode2session';
    }

    public function getOptions(): array
    {
        $params = [
            'js_code' => $this->code,
            'grant_type' => 'authorization_code',
        ];

        if ($this->component) {
            $params['component_appid'] = $this->component->getAppId();
            $params['component_access_token'] = $this->component->getAccessToken();
        } else {

        }

        return $params;
    }
}