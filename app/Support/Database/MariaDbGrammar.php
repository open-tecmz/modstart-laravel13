<?php

namespace App\Support\Database;

use Illuminate\Database\Schema\Grammars\MariaDbGrammar as BaseMariaDbGrammar;

/**
 * MariaDB Schema 语法（兼容 MariaDB 10.1 及以下版本的 information_schema）
 *
 * 仅重写 compileColumns，其余行为与框架原生 MariaDbGrammar 完全一致。
 */
class MariaDbGrammar extends BaseMariaDbGrammar
{
    use SupportLegacyColumns;
}
