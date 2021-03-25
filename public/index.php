<?php
/**
 * 应用入口文件
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

use think\App;

require __DIR__ . '/../vendor/autoload.php';


$app = new App();
$http = $app->debug()->setNamespace('XinFox')->http;

$response = $http->run();
$response->send();

$http->end($response);