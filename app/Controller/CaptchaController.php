<?php
/**
 * 当前文件功能说明
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Annotator\Validate;
use XinFox\Annotation\Route;
use XinFox\BaseController;

class CaptchaController extends BaseController
{
    /**
     * @Route("/captcha", method="POST")
     * @Validate()
     */
    public function create(): Json
    {
        $data = $this->request->put();
        return success_response($data);
    }
}