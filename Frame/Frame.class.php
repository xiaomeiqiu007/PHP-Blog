<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/21
 * Time: 21:52
 */
//声明命名空间
namespace Frame;
//定义最终的框架初始类
final class Frame
{
    //初始化方法
    public static function run()
    {
        self::initCharset();   //初始化字符集设置
        self::initConfig();    //初始化配置文件
        self::initRoute();     //初始化路由参数
        self::initConst();     //初始化常量目录设置
        self::initAutoLoad();  //初始化类的自动加载
        self::initDispatch();  //初始化请求的分发
    }

    private static function initCharset()
    {
        header("content-type:text/html;charset=utf-8");
    }

    private static function initConfig()
    {
        //配置文件路径：./Home/Conf/Config.php
        //echo APP_PATH."Conf".DS."Config.php";
        $GLOBALS['config'] = require_once(APP_PATH . "Conf" . DS . "Config.php");
    }

    //私有的静态的初始化路由参数
    private static function initRoute()
    {
        $p = $GLOBALS['config']['default_platform'];    //平台参数
        $c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller'];  //控制器参数
        $a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];//动作参数
        define("PLAT", $p);
        define("CONTROLLER", $c);
        define("ACTHION", $a);
    }

    //设置常见的常量
    private static function initConst()
    {
        // 例如 ./Home/View
        define("VIEW_PATH", APP_PATH . "View" . DS . CONTROLLER . DS);
        define("FRAME_PATH",ROOT_PATH."Frame".DS);  //Frame目录
    }

    private static function initAutoLoad()
    {
        spl_autoload_register(function($className){
            //将空间中的类名，转化为真实的类文件路径
            //空间类中的类名：\home\Controller\StudentController
            //真实的类文件:./Home/Controller/StudentController.class.php\
            $filename = ROOT_PATH.str_replace("\\",DS,$className);
            $filename.=".class.php";
            echo $filename."<br>";
            //如果类文件存在，则包含
            if(file_exists($filename)) require_once($filename);
        });
    }

    //私有静态的请求分发？：创建哪个控制器类的对象？调用对象的那个方法
    private static function initDispatch()
    {
        //构建控制器类名
        $className = "\\".PLAT."\\"."Controller"."\\".CONTROLLER."Controller";
        echo $className."<br>";
        //创建控制器类的对象
        $controllerObj = new $className;
        //调用控制器对象的方法
        $actionName = ACTHION;
        $controllerObj->$actionName();
    }
}