<?php
/**
 * 全局中间件定义文件
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */

declare(strict_types=1);

namespace XinFox;

use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Response;
use Throwable;
use XinFox\Auth\Exception\ForbiddenException;
use XinFox\Auth\Exception\UnauthorizedException;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof UnauthorizedException) {
            return error401_response();
        }

        if ($e instanceof ForbiddenException) {
            return error403_response();
        }

        if ($e instanceof HttpException) {
            return error404_response('访问的URL不存在，请注意HTTP请求类型是否正确');
        }

        if ($e instanceof ValidateException) {
            return error_response($e->getMessage());
        }

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}
