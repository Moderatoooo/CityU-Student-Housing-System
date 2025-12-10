<?php
ob_start();
/**
 * PHP 公共加载文件、主要是做一些初始化工作，将适应不同的php 版本
 */

//  设置出错类型、为非重要错误都不提示、
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// 启动session
session_start();

// 设置当前项目路径
define('ROOT_PATH' , str_replace('initialize.php' ,'',strtr(__FILE__,"\\" , '/')));

// 同上是一致的
define('DT_PATH' , ROOT_PATH);

// 设置PHP 库文件目录
define('INCLUDE_PATH' , ROOT_PATH. 'include/');

//   检测PHP 是否开启get_magic_quotes_gpc  自动将参数转义

define('MAGIC_QUOTES_GPC', false);



//  设置时间区域 为北京
if(function_exists('date_default_timezone_set')) {
    @date_default_timezone_set('PRC');
}

// 设置程序运行所需内存 128M
ini_set('memory_limit', '128m');

// 设置返回头为 utf-8
header('Content-Type: text/html; charset=utf-8');
// 加载公共函数库
require_once INCLUDE_PATH.'common.php';

// 设置 自动加载类 函数
spl_autoload_register('loadClass');



