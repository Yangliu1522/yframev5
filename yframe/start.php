<?php
/**
 * Author: yangyang
 * Date  : 17-12-23
 * Time  : 下午3:43
 */

define('YF_TEMP', true);

$startMem = memory_get_usage();
$start = microtime(true);
// 表示系统路径分隔符
$ds = DIRECTORY_SEPARATOR;
$root_dir = dirname(__FILE__) . $ds;

// require $root_dir . 'library/yang/Loader.php';
// 注册自动加载
// \yang\Loader::base();
// 使用fastload 项目用不到那么多的东西
require $root_dir . 'library/yang/Fastload.php';
\yang\Fastload::create();
\yang\Fastload::listen();
\yang\Fastload::includeFile($root_dir . 'helper.php');
\yang\Error::register();
// 开始写配置, 我们要注册array甚至多个

$config = []; // 初始化声明

$config['yf_start_time'] = $start;
$config['yf_start_mem'] = $startMem;
$config['root_path']     = $root_dir; // 根路径 就是Yframe这个文件夹所在的位置
$config['base_path']     = dirname($root_dir) . $ds;// 根路径的上一级路径
$config['vender_path']   = $config['base_path'] . $ds . 'vendor' . $ds;
$config['static']   = \yang\Common::path2url($config['base_path'] ) . 'public/';

// 公共路径

\yang\Container::register([
    'app' => \yang\App::class,
    'env' => \yang\Env::class,
    'config' => \yang\Config::class,
    'cache' => \yang\Cache::class,
    'debug' => \yang\Debug::class,
    'log' => \yang\Log::class,
    'route' => \yang\Route::class,
    'request' => \yang\Request::class,
]);

\yang\Fastload::alise([
    'App' => \yang\App::class,
    'Env' => \yang\Env::class,
    'Config' => \yang\Config::class,
    'Cache' => \yang\Cache::class,
    'Debug' => \yang\Debug::class,
    'Log' => \yang\Log::class,
]);
// 批量注册系统常量
\yang\Env::setArray($config);
// 公共设置
$config = \yang\Fastload::getContentOfFile($root_dir . 'common/config/config.php');
\yang\Env::setArray($config['env']);
// 这里是应用开始
\yang\Config::setAsArray($config['config']);
// 容器测试
\yang\Container::get('App')->create();
// (new \yang\App)->create();