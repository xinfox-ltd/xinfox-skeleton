<?php
/**
 * 默认控制器
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;

/**
 * @package XinFox\Controller
 */
class IndexController extends BaseController
{
    /**
     * @Route("/", method="GET")
     * @return Json
     */
    public function index(): Json
    {
        return success_response(['Hello' => 'XinFox']);
    }
}