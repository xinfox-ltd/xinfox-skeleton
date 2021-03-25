<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Wechat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MiniProgram
{
    /**
     * https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code
     * https://api.weixin.qq.com/sns/component/jscode2session?appid=APPID&js_code=JSCODE&grant_type=authorization_code&component_appid=COMPONENT_APPID&component_access_token=COMPONENT_ACCESS_TOKEN
     * @param $code
     * @return MiniProgramSession
     * @throws GuzzleException
     */
    public function jsCode2Session($code): MiniProgramSession
    {
        $client = new Client();
        $response = $client->get(
            'https://api.weixin.qq.com/sns/component/jscode2session?appid=APPID&js_code=JSCODE&grant_type=authorization_code&component_appid=COMPONENT_APPID&component_access_token=COMPONENT_ACCESS_TOKEN'
        );
        return new MiniProgramSession();
    }
}