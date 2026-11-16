<?php

namespace App\Providers;

use App\Support\Database\MariaDbGrammar;
use App\Support\Database\MySqlGrammar;
use Illuminate\Database\Connection;
use Illuminate\Database\Events\ConnectionEstablished;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLegacySchemaGrammar();
    }

    /**
     * 兼容 MySQL 5.6 / MariaDB 10.1 等旧版本数据库
     *
     * 框架的 MySqlGrammar::compileColumns() 会查询 information_schema.columns 的
     * generation_expression 列，该列只存在于 MySQL 5.7.6+ / MariaDB 10.2+，
     * 在旧版本上 Schema::getColumnListing() 等调用会报 1054 导致模块迁移失败。
     *
     * @return void
     */
    protected function registerLegacySchemaGrammar()
    {
        // 已建立的连接立即替换（通常 boot 阶段还没有连接，这里是兜底）
        foreach ($this->app['db']->getConnections() as $connection) {
            $this->applyLegacySchemaGrammar($connection);
        }
        // 之后建立的连接（含 reconnect / purge 后重建）通过事件替换
        Event::listen(ConnectionEstablished::class, function ($event) {
            if (isset($event->connection)) {
                $this->applyLegacySchemaGrammar($event->connection);
            }
        });
    }

    /**
     * 为 MySQL / MariaDB 连接替换 Schema 语法
     *
     * @param mixed $connection
     * @return void
     */
    protected function applyLegacySchemaGrammar($connection)
    {
        if (!$connection instanceof Connection) {
            return;
        }
        $driver = $connection->getDriverName();
        if ('mysql' === $driver) {
            $connection->setSchemaGrammar(new MySqlGrammar($connection));
        } elseif ('mariadb' === $driver) {
            $connection->setSchemaGrammar(new MariaDbGrammar($connection));
        }
    }
}
