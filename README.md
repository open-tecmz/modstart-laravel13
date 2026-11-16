<p align="center">
  <a href="https://modstart.com">
    <img src="https://ms-assets.modstart.com/data/image/2021/09/08/23652_1f1j_9825.png" alt="ModStart" width="360" />
  </a>
</p>
<p align="center">
  基于 Laravel 13 的模块化建站框架
</p>

<p align="center">
  <a href="https://modstart.com" target="_blank">
    <img alt="Framework ModStart" src="https://img.shields.io/badge/Framework-ModStart-blue">
  </a>
  <a href="https://laravel.com" target="_blank">
    <img alt="Laravel 13" src="https://img.shields.io/badge/Laravel-13.x-red">
  </a>
  <a href="https://www.php.net" target="_blank">
    <img alt="PHP 8.3+" src="https://img.shields.io/badge/PHP-8.3%2B-red">
  </a>
  <a href="https://vuejs.org" target="_blank">
    <img alt="Vue / Element UI" src="https://img.shields.io/badge/JS-Vue%20%2F%20ElementUI-green">
  </a>
  <a href="https://www.mysql.com" target="_blank">
    <img alt="MySQL 8.0+" src="https://img.shields.io/badge/MySQL-8.0%2B-orange">
  </a>
</p>

# ModStart Laravel 13

##  🔥 功能一览

本项目在 ModStart 6.0 基础库之上做过精简装配，默认只启用必要模块，开箱即用。

- 欢迎首页：`Welcome` 提供介绍型首页，说明框架能力并提供后台 / 文档 / 模块市场入口
- 站点设置：`Site` 提供站点名称、Logo、SEO、备案、主色调等基础配置
- 导航管理：`Nav` 提供头部 / 底部 / 底部次导航三个展示位置
- 后台管理：`AdminManager` 提供基于 RBAC 的权限管理，多管理员多角色，手机 / 平板 / PC 均可管理
- 模块市场：`ModuleStore` 提供后台在线安装、卸载、升级
- 开发助手：`ModuleDeveloper` 一键创建模块、打包与发布
- 基础能力：`Vendor` 提供字段、表格、表单、文件上传、测试基座等通用能力

##  💡 系统简介

本项目是基于 **Laravel 13** 的内容建站系统，运行于 **PHP 8.3+**，底座为 **ModStart 6.0.0** 基础库。

`config/module.php` 注册 6 个核心模块：`Vendor`、`AdminManager`、`ModuleStore`、`Site`、`Nav`、`Welcome`；`.env` 的 `MS_MODULES` 另外强制启用 `ModuleDeveloper`，运行时实际共 7 个模块。后台干净、启动更快。

前台首页由 `Welcome` 模块提供：它在 `Core/ModuleServiceProvider` 中向 `HomePageProvider` 注册，`app/Web/Controller/IndexController` 的默认首页动作指向 `\Module\Welcome\Web\Controller\IndexController@index`。需要换首页时，启用 `HomePageSwitcher` 后在后台切换，或直接修改该默认动作指向其它模块。

`module/` 下的模块代码保持 Laravel 5.1 / 9 / 13 三版本通用语法，同一份模块可运行在 ModStart 的各发行版上。

- [ModStart 官方网站](https://modstart.com)
- [模块市场](https://modstart.com/store)
- [开发文档](https://modstart.com/doc)

**技术栈**

- [Laravel 13](https://laravel.com/)
- [ModStart 基础库](https://modstart.com/doc)
- [Vue](https://vuejs.org/)
- [Element UI](https://element.eleme.io/)
- [jQuery](http://jquery.com)

##  💥 系统特性

- 全模块化开发，积木式搭建系统，可灵活组合
- 简洁优雅、灵活可扩展，可实现大型复杂系统
- 后台 RBAC 权限管理，多管理员多角色管理
- 丰富的数据表格、数据表单、数据详情功能
- 内置文件上传、分片上传，无需繁琐开发
- 丰富的模块市场，后台一键快速安装
- 基础库能力内置优先，不额外引入第三方 PHP 依赖

## 🎨 系统演示

> 演示站为完整功能装配（含会员、CMS、博客等模块），与本仓库默认的精简装配不同，仅用于查看 ModStart 的能力边界。

### 前台演示地址

[https://demo-modstart-laravel13.modstart.com](https://demo-modstart-laravel13.modstart.com)

> 演示数据会定期重置

### 后台演示地址

[https://demo-modstart-laravel13.modstart.com/admin/](https://demo-modstart-laravel13.modstart.com/admin/)

> 管理员账号以演示站点登录页提示为准

## 🎁 模块市场

丰富的模块市场，后台一键安装模块应用

![模块市场](https://ms-assets.modstart.com/data/image/2022/01/12/21242_me7h_4616.jpg)

## 🌐 开发文档

[https://modstart.com/doc](https://modstart.com/doc)

##  🔧 系统安装

### 环境要求

| 项目 | 要求 |
|---|---|
| PHP | `>= 8.3`（`composer.json` 的 `require.php` 为 `^8.3`，本机实测 `8.5.12`） |
| MySQL | `>= 8.0` |
| PHP 扩展 | `fileinfo`、`pdo_mysql`、`mbstring`、`openssl`、`curl`、`zip`、`bcmath`、`tokenizer`（`exif` 选填） |
| PHP 函数 | `proc_open`、`putenv`、`proc_get_status` 未被禁用 |
| 运行环境 | 64 位 PHP；`bootstrap/`、`bootstrap/cache/`、`storage/`、`public/` 目录可写 |
| Web 服务器 | `Nginx` / `Apache`，站点运行目录指向 `public/`，需支持 Rewrite |
| Composer | `2.x` |
| Node.js | 仅在重新编译前端资源、运行截图 / UI 测试时需要 |

> 版本门槛以 `composer.json` 的 `require.php`（`^8.3`）为准，安装向导与 artisan 均按此校验；本文档命令统一使用 `php85`（PHP 8.5.12）。
>
> PHP 8.5 注意：`opcache` 自 8.5 起已内置（面板「安装扩展」里不再提供），`disable_classes` 配置项已移除，`curl_close` / `finfo_close` / `imagedestroy` 已弃用（由内置兼容层处理）；宝塔 PHP 8.4 / 8.5 的「极速安装」包可能未包含 `--enable-zip`，需改用「编译安装」并添加 `--enable-zip`，或先使用 PHP 8.1 / 8.2。安装页检测不通过时会展开「环境诊断与修复指引」，输出站点实际使用的 `php.ini`、`extension_dir` 与已加载扩展清单，便于核对面板与站点是否同一个 PHP。

### 命令行安装

```bash
composer install
# vendor/modstart/modstart 不由 Composer 托管（本仓库已包含）；若目录缺失，先执行 make Install 拉取基础库
cp .env.example .env            # 填写 DB_HOST / DB_PORT / DB_DATABASE / DB_USERNAME / DB_PASSWORD
php85 artisan key:generate
php85 artisan modstart:init --username=admin --password=123456
```

`modstart:init` 会依次执行数据库迁移、安装 `config/module.php` 中已启用的模块、创建后台管理员，最后写入 `storage/install.lock`；追加 `--demo` 可同时导入演示数据。上面的步骤与 `make Install` 等价。`storage/install.lock` 已加入 `.gitignore`，每台环境各自安装。

### 安装向导

部署代码并完成 `composer install` 后，浏览器访问：

```
http://your-domain/install.php
```

向导共两步（环境检查 → 配置安装），页面在 `public/install.php`，逻辑在
`module/Vendor/Installer/install.php`，接口为 `module/Vendor/Web/routes.php` 中的
`install/ping`、`install/prepare`、`install/execute`、`install/lock`：

1. **环境检查**：PHP 版本（按 `composer.json` 的 `require.php` 约束校验）、扩展与函数、目录可写、Rewrite 规则（`/install/ping` 返回 `ok` 才算通过）与 `.env` 可写性；
2. **配置安装**：填写 MySQL 连接与后台管理员账号 → `/install/prepare` 校验数据库连接并按 `.env.example` 生成 `.env` → `/install/execute` 执行 `migrate`、创建管理员、逐个安装模块，最后写入 `storage/install.lock`。

注意：

- 站点运行目录必须指向 `public/`（页面提示「安装路径为 public/install.php」即说明根目录配置有误）；
- 需要重装时必须先删除 `storage/install.lock`，并清空 `.env` 中的 `DB_HOST` 等连接信息（`prepare` 会拒绝覆盖已有数据库配置的 `.env`）；
- 向导从 `.env.example` 生成 `.env`，其中的 `APP_KEY`、`ENCRYPT_KEY` 由安装器随机生成，`MS_MODULES` 等固定项原样保留；
- 后台入口由 `.env` 的 `ADMIN_PATH` 控制，默认 `/admin/`；
- 安装完成后建议删除 `public/install.php`（保留也可，向导会提示「系统无需重复安装」）。

### 目录结构

```
app/                      项目应用层（Admin / Web / Api / Exceptions / Providers）
app/Web/routes.php        应用前台路由（含首页），与模块路由一起由 ModStartServiceProvider 注册
app/Web/Controller/       前台控制器（首页入口 IndexController 指向 Welcome 模块）
app/Admin/Controller/     后台控制器（首页 Dashboard 依赖 AdminManager）
bootstrap/app.php         Laravel 13 应用骨架：注册 ModStart ServiceProvider、全局 Cookie / Session、异常桥接
config/module.php         系统模块注册表（默认注册 6 个核心模块）
database/migrations/      ModStart 核心表迁移
module/                   模块目录
module/Welcome/           欢迎首页模块（介绍页 + 首页提供者 + 后台首页信息卡片 + 截图脚本）
public/asset              基础库静态资源（vendor:publish --tag=modstart 发布）
public/vendor             模块静态资源（模块安装时发布）
public/theme/             站点级静态资源（theme/default/css/style.css 覆盖主题样式）
resources/views/errors/   错误页（ErrorPage 模块未启用时使用 ModStart 默认样式）
resources/views/theme/    前台默认主题（header / footer 按 modstart_module_enabled() 与模块解耦）
scripts/                  诊断与冒烟脚本（类加载 / 菜单 / 模板 / 路由 / 页面）
vendor/modstart/modstart  ModStart 6.0.0 基础库（随仓库提供，非 Composer 托管）
```

> 前台路由不使用 Laravel 默认的 `routes/web.php`（本仓库没有 `routes/` 目录）：`app/Web/routes.php` 与各启用模块的 `Web/routes.php` 由 `ModStartServiceProvider`（`ModStartWeb::registerModuleRoutes`）统一注册。

### 首页与主题

- **首页链路**：`app/Web/Controller/IndexController::index()` → `HomePageProvider::call()` → `module/Welcome/Core/ModuleServiceProvider` 注册的 `WelcomeHomePageProvider` → `\Module\Welcome\Web\Controller\IndexController@index` → `module/Welcome/View/pc/welcome/index.blade.php`。
- **换首页**：启用 `HomePageSwitcher` 模块后在后台「首页切换器」选择；或修改 `app/Web/Controller/IndexController` 的默认首页动作；或在自己的模块 `Core/ModuleServiceProvider` 中 `HomePageProvider::register()` 注册新的首页提供者。
- **主题模板**：`resources/views/theme/default/pc/`（`frame.blade.php` + `share/header.blade.php` + `share/footer.blade.php`）。模板中用 `modstart_module_enabled('Member')`、`modstart_module_enabled('Nav')` 判断模块能力，模块未启用时自动隐藏相关区域，不会报错。
- **样式覆盖**：`public/theme/default/css/style.css` 加载在编译产物之后，用于站点级覆盖（如主色调、页脚深色区域文字色），无需重新编译。

### 升级指南

参照 [https://modstart.com/doc/install/upgrade.html](https://modstart.com/doc/install/upgrade.html)

升级后如静态资源有变化，执行 `make PublishAsset` 重新发布基础库与模块资源。

##  🔨 开发速看

以下以一个简单的「新闻管理」模块为例，快速了解 ModStart 模块开发的大致流程。

### 模块目录

```
module/News/
├── Admin/
│   ├── Controller/NewsController.php
│   └── routes.php
├── Core/ModuleServiceProvider.php
├── Migrate/
├── Model/News.php
├── View/pc/
├── Test/
├── Docs/release.md
├── config.json
└── README.md
```

> 模块生命周期内需同步维护 `README.md` 与 `Docs/release.md`（更新记录）。

### 模块声明 `config.json`

```json
{
  "name": "News",
  "title": "新闻管理",
  "version": "1.0.0",
  "author": "官方",
  "env": ["laravel5", "laravel9", "laravel13"],
  "require": ["Vendor:>=3.0.0"],
  "suggest": [],
  "modstartVersion": ">=6.0.0",
  "description": "新闻管理示例模块",
  "providers": [],
  "config": {}
}
```

### 数据表迁移 `Migrate/2026_11_03_000000_news_create.php`

```php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsCreate extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title', 200)->nullable()->comment('标题');
            $table->string('cover', 200)->nullable()->comment('封面');
            $table->text('content')->nullable()->comment('内容');
        });
    }

    public function down()
    {
        //
    }
}
```

> 无需 `hasTable` 守卫（重复执行由 `migrations` 表兜底）；类名必须等于文件名去掉日期序号的 StudlyCase（`news_create.php` → `NewsCreate`）；字段一律 `nullable()`，`down()` 留空。

### 模型 `Model/News.php`

```php
namespace Module\News\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
}
```

### 控制器 `Admin/Controller/NewsController.php`

```php
namespace Module\News\Admin\Controller;

use Illuminate\Routing\Controller;
use ModStart\Admin\Concern\HasAdminQuickCRUD;
use ModStart\Admin\Layout\AdminCRUDBuilder;
use ModStart\Grid\GridFilter;
use ModStart\Support\Concern\HasFields;
use Module\News\Model\News;

class NewsController extends Controller
{
    use HasAdminQuickCRUD;

    protected function crud(AdminCRUDBuilder $builder)
    {
        $builder
            ->init(News::class)
            ->field(function ($builder) {
                /** @var HasFields $builder */
                $builder->id('id', 'ID');
                $builder->text('title', '标题');
                $builder->image('cover', '封面');
                $builder->richHtml('content', '内容');
                $builder->display('created_at', '创建时间');
                $builder->display('updated_at', '更新时间');
            })
            ->gridFilter(function (GridFilter $filter) {
                $filter->eq('id', 'ID');
                $filter->like('title', '标题');
            })
            ->title('新闻管理');
    }
}
```

### 路由 `Admin/routes.php`

```php
/* @var \Illuminate\Routing\Router $router */
$router->match(['get', 'post'], 'news', 'NewsController@index');
$router->match(['get', 'post'], 'news/add', 'NewsController@add');
$router->match(['get', 'post'], 'news/edit', 'NewsController@edit');
$router->match(['post'], 'news/delete', 'NewsController@delete');
$router->match(['get'], 'news/show', 'NewsController@show');
```

### 后台菜单 `Core/ModuleServiceProvider.php`

```php
namespace Module\News\Core;

use Illuminate\Support\ServiceProvider;
use ModStart\Admin\Config\AdminMenu;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        AdminMenu::register(function () {
            return [
                [
                    'title' => '新闻管理',
                    'icon' => 'description',
                    'sort' => 200,
                    'url' => '\Module\News\Admin\Controller\NewsController@index',
                ]
            ];
        });
    }

    public function register()
    {
    }
}
```

### 安装并启用模块

新增模块无需修改 `.gitignore`（当前没有 `module/` 的忽略规则；若日后添加 `/module/*` 之类规则，需要补 `!/module/News/`），执行安装（跑迁移 + 发布模块静态资源）：

```bash
php85 artisan modstart:module-install News
```

新安装的模块默认 `enable => false`，在后台「模块管理」里启用即可；如需固定为系统模块，在
`config/module.php` 的 `system` 段注册：

```php
'News' => [
    'enable' => true,
],
```

这样一个简单的新闻增删改查模块就开发完成了。

## ⌨️ 常用命令

| 命令 | 说明 |
|---|---|
| `php85 artisan modstart:module-list` | 列出已安装 / 已启用模块 |
| `php85 artisan modstart:module-enable <Module>` | 启用模块 |
| `php85 artisan modstart:module-disable <Module>` | 禁用模块 |
| `php85 artisan modstart:module-install <Module> [--force]` | 安装模块（迁移 + 发布资源） |
| `php85 artisan modstart:module-install-all` | 按依赖顺序安装所有已启用模块 |
| `php85 artisan modstart:module-refresh-all` | 刷新模块缓存（启停模块后执行） |
| `php85 artisan modstart:init [--username --password --demo]` | 初始化：迁移 + 安装模块 + 建管理员 |
| `php85 artisan optimize:clear` | 清理配置 / 路由 / 视图 / 应用缓存 |

##  🧪 测试

```bash
php85 artisan modstart:seed-test                      # 全量（seed / api / biz / ui 四阶段，默认重建测试库）
php85 artisan modstart:seed-test --module=Site        # 定向：只测受影响模块（默认不重建库，需重建加 --reset）
php85 artisan modstart:seed-test --phase=api,biz      # 只跑接口与业务阶段
make Test                                             # 全量测试的等价入口
make Test.Module MODULE=Site                          # 定向测试的等价入口
```

> Seed 阶段仅在 `.env` 设置 `AUTO_TEST=true` 时真正写入数据；UI 阶段会启动 `php artisan serve` 与 headless Chrome（依赖 `playwright-core`，首次运行自动安装到 `~/.modstart/auto-test`）。

### 冒烟脚本

| 改动类型 | 该跑哪个脚本 |
|---|---|
| 新增 / 修改类文件 | `php85 scripts/class-load-smoke.php` |
| 后台菜单、`Class@method` 解析 | `php85 scripts/menu-url-smoke.php` |
| Blade 模板 | `php85 scripts/blade-compile-smoke.php`、`php85 scripts/blade-compat-smoke.php --env=laravel13`（配合 `php56 … --env=laravel5`、`php81 … --env=laravel9`） |
| 路由目标 | `php85 scripts/route-target-smoke.php` |
| 页面渲染 | `php85 scripts/page-smoke.php --group=admin`、`php85 scripts/http-smoke.php` |

## 📋 常见问题

- 安装向导提示「系统无需重复安装」：删除 `storage/install.lock` 后重试
- 后台菜单 / 页面 500 且刚装过或切过模块：依次执行 `php85 artisan optimize:clear` 与 `php85 artisan modstart:module-refresh-all`，必要时再 `php85 artisan modstart:module-install-all` 重新发布模块资源
- 启停模块后前台菜单 / 页脚仍显示旧内容：执行 `php85 artisan optimize:clear`（生产环境模块 ServiceProvider、路由与配置均有缓存）
- 前台 header / footer 使用了某个模块的能力（会员入口、导航、搜索框）：模板统一用 `modstart_module_enabled('Member')` 等条件包裹，模块未启用时自动隐藏，不会报错
- 页面样式或脚本不生效：执行 `make PublishAsset` 重新发布静态资源
- 安装、部署等问题：[https://modstart.com/doc/install/qa.html](https://modstart.com/doc/install/qa.html)

如有其他问题推荐使用官方讨论交流群或在线讨论

- [https://modstart.com/forum](https://modstart.com/forum)

## ⭐️ 贡献代码

- `GitHub` [https://github.com/open-tecmz/modstart-laravel13](https://github.com/open-tecmz/modstart-laravel13)
- `Gitee` [https://gitee.com/open-tecmz/modstart-laravel13](https://gitee.com/open-tecmz/modstart-laravel13)

## ✉️ 使用交流

> 添加好友请备注 ModStart Laravel 13

<table width="100%">
    <thead>
        <tr>
            <th width="50%">微信交流群</th>
            <th>QQ交流群</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <img style="width:100%;"
                     src="https://open.tecmz.com/code_dynamic/wx" />
            </td>
            <td>
                <img style="width:100%;"
                     src="https://open.tecmz.com/code_dynamic/qq" />
            </td>
        </tr>
    </tbody>
</table>
