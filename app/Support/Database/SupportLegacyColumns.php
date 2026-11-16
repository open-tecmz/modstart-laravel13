<?php

namespace App\Support\Database;

/**
 * 旧版本 MySQL / MariaDB 的列信息查询兼容
 *
 * Laravel 的 MySqlGrammar::compileColumns() 固定查询 information_schema.columns 的
 * generation_expression 列，而该列只存在于 MySQL 5.7.6+ / MariaDB 10.2+。在
 * MySQL <= 5.6 / MariaDB <= 10.1 上会直接报
 *   SQLSTATE[42S22]: Column not found: 1054 Unknown column 'generation_expression'
 * 导致 Schema::getColumnListing() / Schema::hasColumn() / 模块迁移里的列判断全部失败。
 *
 * 这里在服务端版本不支持该列时改用等价查询（expression 固定为 null），
 * 新版本数据库仍然走框架原生实现，行为保持一致。
 */
trait SupportLegacyColumns
{
    /**
     * 服务端是否支持 generation_expression，null 表示尚未探测
     *
     * @var bool|null
     */
    protected $serverSupportsGenerationExpression = null;

    /**
     * Compile a columns query.
     *
     * @param string|null $schema
     * @param string $table
     * @return string
     */
    public function compileColumns($schema, $table)
    {
        if ($this->supportsGenerationExpression()) {
            return parent::compileColumns($schema, $table);
        }
        return sprintf(
            'select column_name as `name`, data_type as `type_name`, column_type as `type`, '
            . 'collation_name as `collation`, is_nullable as `nullable`, '
            . 'column_default as `default`, column_comment as `comment`, '
            . 'null as `expression`, extra as `extra` '
            . 'from information_schema.columns where table_schema = %s and table_name = %s '
            . 'order by ordinal_position asc',
            $schema ? $this->quoteString($schema) : 'schema()',
            $this->quoteString($table)
        );
    }

    /**
     * 服务端是否支持 generation_expression 列（结果按连接缓存一次）
     *
     * @return bool
     */
    protected function supportsGenerationExpression()
    {
        if (null !== $this->serverSupportsGenerationExpression) {
            return $this->serverSupportsGenerationExpression;
        }
        $version = '';
        try {
            $version = (string)$this->connection->getServerVersion();
        } catch (\Exception $e) {
            // 取不到版本时按旧版本处理：旧查询在新旧数据库上都能正常执行
        } catch (\Throwable $e) {
            // PHP 7+ 的 Error（如连接已断开）同样兜底
        }
        $this->serverSupportsGenerationExpression = $this->versionSupportsGenerationExpression($version);
        return $this->serverSupportsGenerationExpression;
    }

    /**
     * 版本号是否支持 generation_expression（MySQL 5.7.6+ / MariaDB 10.2+）
     *
     * @param string $version
     * @return bool
     */
    protected function versionSupportsGenerationExpression($version)
    {
        $version = trim((string)$version);
        if ('' === $version) {
            return false;
        }
        // MariaDB 会带上 MySQL 兼容前缀，如 5.5.5-10.1.48-MariaDB-0ubuntu0.18.04.1，
        // 真实版本号是最后一段，不能用开头的 5.5.5 判断
        if (false !== stripos($version, 'mariadb')) {
            if (!preg_match_all('/(\d+)\.(\d+)\.(\d+)/', $version, $matched)) {
                return false;
            }
            $realVersion = $matched[0][count($matched[0]) - 1];
            return version_compare($realVersion, '10.2.0', '>=');
        }
        if (!preg_match('/^(\d+)\.(\d+)\.(\d+)/', $version, $matched)) {
            return false;
        }
        return version_compare($matched[0], '5.7.6', '>=');
    }
}
