<?php
/**
 * 默认控制器
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Controller;

use think\Request;
use think\response\Json;
use XinFox\Annotation\Annotator\Inject;
use XinFox\Annotation\Route;
use XinFox\Auth\Auth;
use XinFox\Auth\VisitorInterface;
use XinFox\BaseController;
use XinFox\User;


/**
 * @package XinFox\Controller
 */
class IndexController extends BaseController
{
    /**
     * @Route("/api", method="GET", roles={"admin", "seller"})
     * @return Json
     */
    public function index(): Json
    {
        return success_response(['Hello' => $this->visitor->getRole()]);
    }

    /**
     * @Route("/test", method="GET")
     * @return Json
     */
    public function test1()
    {
        echo (string)$this->auth->login(new User());
        //$this->auth->logout();
    }
}