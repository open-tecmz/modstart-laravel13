<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

// CLI（artisan）入口不会定义 LARAVEL_START，ModStart 的异常统计逻辑会读取该常量
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

return Application::configure(basePath: dirname(__DIR__))
    // 不使用 Laravel 默认的路由注册（routes/web.php / routes/console.php / health 路由）：
    // 前台路由全部由 ModStartServiceProvider（ModStartWeb::registerModuleRoutes）注册，
    // 即 app/Web/routes.php 与各模块的 Web/routes.php
    ->withProviders([
        // ModStart 基础库（vendor/modstart/modstart，非 Composer 托管，由根 composer.json 注入自动加载）
        \ModStart\ModStartServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        // ModStart 的模块路由在 ServiceProvider 中直接注册（不在 web 组内），
        // 因此 Cookie / Session 必须以全局中间件方式挂载，与 Laravel 5 / 9 版本行为保持一致。
        $middleware->append(\Illuminate\Cookie\Middleware\EncryptCookies::class);
        $middleware->append(\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class);
        $middleware->append(\Illuminate\Session\Middleware\StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->dontReport([
            \Illuminate\Database\Eloquent\ModelNotFoundException::class,
            \ModStart\Core\Exception\BizException::class,
        ]);
        $exceptions->report(function (\Throwable $e) {
            \App\Exceptions\ExceptionBridge::report($e);
        });
        $exceptions->render(function (\Throwable $e, Request $request) {
            return \App\Exceptions\ExceptionBridge::render($e, $request);
        });
    })
    ->create();
