<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => 'localhost', // 服务器地址
    'DB_NAME'                => 'jd', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'jd_', // 数据库表前缀
    'SESSION_AUTO_START'     => false, // 是否自动开启Session
    'URL_MODEL'              => 2, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_ROUTER_ON'          => true, // 是否开启URL路由
    'URL_ROUTE_RULES'        => [], // 默认路由规则 针对模块
    'LAYOUT_ON' => true, // 打开layout功能


);