<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/18
 * Time: 20:05
 */
//定义Home应用配置信息数组
return array(
    //数据库配置
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_port' => '3306',
    'db_user' => 'root',
    'db_pass' => 'root',
    'db_name' => 'php_blog',
    'charset' => 'utf8',

    //前端默认url路由参数
    'default_platform' => 'Home',       //默认配置文件
    'default_controller' => 'Index',
    'default_action' => 'index',       //
);