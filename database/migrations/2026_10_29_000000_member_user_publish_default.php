<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * member_user 的自动发布开关补充默认值
 *
 * FocusAny（pluginAutoPublish）与 ModStart（moduleAutoPublish）分别给 member_user 增加了
 * tinyInteger 列但未设置默认值，MySQL 严格模式下没有带这些字段的 insert 会报
 * "Field 'xxx' doesn't have a default value"。
 */
class MemberUserPublishDefault extends Migration
{
    public function up()
    {
        if (Schema::hasTable('member_user')) {
            if (Schema::hasColumn('member_user', 'pluginAutoPublish')) {
                DB::statement("ALTER TABLE `member_user` MODIFY `pluginAutoPublish` TINYINT NOT NULL DEFAULT 0 COMMENT '模块提交自动发布'");
            }
            if (Schema::hasColumn('member_user', 'moduleAutoPublish')) {
                DB::statement("ALTER TABLE `member_user` MODIFY `moduleAutoPublish` TINYINT NOT NULL DEFAULT 0 COMMENT '模块提交自动发布'");
            }
        }
    }

    public function down()
    {
    }
}
