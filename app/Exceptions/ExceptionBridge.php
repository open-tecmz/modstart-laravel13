<?php

namespace App\Exceptions;

use ModStart\Core\Exception\ExceptionReportHandleTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

/**
 * 异常上报与响应桥接
 *
 * Laravel 11+ 取消了 App\Exceptions\Handler 的可覆盖点（renderExceptionResponse 等），
 * 统一改为在 bootstrap/app.php 的 withExceptions() 闭包中注册。
 * 这里把 ModStart 的异常处理 trait 以桥接类的方式暴露出来，行为与 Laravel 5 / 9 版本保持一致。
 */
class ExceptionBridge
{
    use ExceptionReportHandleTrait {
        errorReportCheck as public;
        getExceptionResponse as public;
        isPageRequest as public;
        isExceptionIgnore as public;
    }

    /**
     * 错误上报（ERROR_REPORT_URL）
     * @param Throwable $e
     */
    public static function report($e)
    {
        $bridge = new static();
        $bridge->errorReportCheck($e);
    }

    /**
     * 异常响应
     * @param Throwable $e
     * @param mixed $request
     * @return mixed|null 返回 null 时交由框架默认处理（调试页面 / 404 页面等）
     */
    public static function render($e, $request = null)
    {
        $bridge = new static();
        $response = $bridge->getExceptionResponse($e);
        if (null !== $response) {
            return $response;
        }
        // 业务异常已在 getExceptionResponse 中处理，这里只兜底页面级 500
        if (config('app.debug')) {
            return null;
        }
        if ($e instanceof HttpException) {
            // 4xx / 5xx 的 HTTP 异常交由框架输出对应状态码页面
            return null;
        }
        if (!$bridge->isPageRequest()) {
            return null;
        }
        return response()->view('errors.500', ['exception' => $e], 500);
    }
}
