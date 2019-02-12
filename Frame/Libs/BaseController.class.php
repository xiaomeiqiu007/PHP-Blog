<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/2/3
 * Time: 15:15
 */
//定义命名空间
namespace Frame\Libs;

abstract class BaseController{
    //受保护的Smarty对象
    protected $smarty = NULL;

    //公共的构造方法
    public function __construct()
    {
        $this->initSmarty();
    }
    private function initSmarty()
    {
        //创建Smarty类的对象
        $smarty = new \Frame\Vendor\Smarty();
        //Smarty配置
        $smarty->left_delimiter = "<{"; //左定界符
        $smarty->right_delimiter = "}>"; //右定界符
        $smarty->setTemplateDir(VIEW_PATH); //设置视图文件目录
        $smarty->setCompileDir(sys_get_temp_dir().DS."view".DS); //设置编译目录(缓存目录) 放在操作系统的临时目录
        //给$Smarty属性复制
        $this->smarty = $smarty;
    }

    //受保护的跳转方法
    protected function jump($message,$url="?",$time=3)
    {
        echo "<h2>{$message}</h2>";
        header("refresh:{$time};url={$url}");
        die();
    }
}