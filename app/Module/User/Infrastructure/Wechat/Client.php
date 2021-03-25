<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Module\User\Infrastructure\Wechat;

/**
 * Class Client
 * @property MiniProgram miniProgram
 * @package XinFox\Module\User\Infrastructure\Wechat
 */
class Client
{
    private array $instances = [];

    public function request(ApiInterface $api)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request($api->getMethod(), $api->getUri(), $api->getOptions());

        return $api->response($response);
    }

    public function get($name)
    {

    }

    public function __get($name)
    {
        return $this->get($name);
    }
}