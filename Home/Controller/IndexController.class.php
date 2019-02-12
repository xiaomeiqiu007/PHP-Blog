<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/23
 * Time: 15:01
 */
namespace Home\Controller;
use \Home\Model\IndexModel;
use \Frame\Libs\BaseController;
//定义最终的首页控制器类,并继承基础控制器
final class IndexController extends BaseController{
    //首页显示的方法
    public function index()
    {
        //创建模型类对象
        $modelObj = IndexModel::getInstance();
        //获取多行数据
        $arrs = $modelObj->fetchAll();
        //载入视图文件
        var_dump($modelObj);
        var_dump($arrs);
        $this->smarty->assign("arrs",$arrs);
        $this->smarty->display("index.html");
        //include VIEW_PATH."index.html";
    }
    public function delete()
    {
        //获取传递过来的id
        $id = $_GET['id'];
        //创建模型对象
        $modelObj = IndexModel::getInstance();
        if($modelObj->delete($id))
        {
            $this->jump("id={$id}的记录删除成功！","?c=Index");
        }else{
            $this->jump("id={$id}的记录删除失败！","?c=Index");
        }

    }
}