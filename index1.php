<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件


header('content-type:text/html;charset=utf-8');
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
//创建admin模块
//define('BIND_MODULE','Admin');
// 定义应用目录
define('APP_PATH','./Application/');

//定义后台公共资源目录
//http://3.xiaoapache.sinaapp.com/
//http://localhost/food
define("SITE_URL", "http://210.38.136.73");
define("ADMIN_PUBLIC", SITE_URL . "/Application/Admin/Public");
define("HOME_PUBLIC", SITE_URL . "/Application/Home/Public");
define("ADMIN_UEDITOR", SITE_URL . "/Application/Ueditor");

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单