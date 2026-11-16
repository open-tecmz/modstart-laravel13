<?php

namespace App\Support\Database;

use Illuminate\Database\Schema\Grammars\MySqlGrammar as BaseMySqlGrammar;

/**
 * MySQL Schema 语法（兼容 MySQL 5.6 等旧版本的 information_schema）
 *
 * 仅重写 compileColumns，其余行为与框架原生 MySqlGrammar 完全一致。
 */
class MySqlGrammar extends BaseMySqlGrammar
{
    use SupportLegacyColumns;
}
