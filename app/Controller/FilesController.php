<?php
/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Controller;

use think\response\Json;
use XinFox\Annotation\Route;
use XinFox\BaseController;

/**
 * 文件处理类
 * Class FilesController
 * @package XinFox\Controller
 */
class FilesController extends BaseController
{
    /**
     * 上传文件
     * @Route("/v1/files", method="POST")
     */
    public function create(): Json
    {
        $file = $this->request->file('file');
        //validate(['file' => 'filesize:102400'])->check(['file' => $file]);

        $path = $this->request->post('type', 'temp');
        // 上传到本地服务器
        $fileName = \think\facade\Filesystem::disk('public')->putFile($path, $file);

        return success_response(['file' => (string)\think\facade\Route::buildUrl($fileName)->domain(true)]);
    }
}