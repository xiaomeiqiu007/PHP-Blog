<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/27
 * Time: 13:43
 */

namespace Frame\Libs;
use \Frame\Vendor\PDOWrapper;
//定义抽象的最终的抽象基础模型
abstract class BaseModel
{
    //受保护的pdo对象属性
    protected $pdo = NULL;
    //受保护的静态的保存不同模型对象的数组属性
    private static $arrModelObj = array();
    //构造方法
    public function __construct()
    {
        $this->pdo = new PDOWrapper();
    }

    //公共的讲静态的创建模型类的方法
    public static function getInstance()
    {
        //获取静态化方法调用类
        $modelClassName = get_called_class();
        //判断当前模型类对象是否存在
        /*
        * $arrModeObj['\Home\Model\StudentModel'] = 学生模型类对象
        * */
        if(!isset(self::$arrModelObj[$modelClassName])){
            //如果当前模型类对象不存在
            self::$arrModelObj[$modelClassName] = new $modelClassName();
        }
        return self::$arrModelObj[$modelClassName];
    }
}