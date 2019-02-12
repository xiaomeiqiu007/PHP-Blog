<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/23
 * Time: 15:11
 */
namespace Home\Model;

//定义最终的首页模型类
use Frame\Libs\BaseModel;
final class IndexModel extends BaseModel{
    //获取多行数据
    public function fetchAll()
    {
        //构建查询的sql语句
        $sql = "SELECT * FROM student ORDER BY id DESC";
        //执行sql语句，返回结果（二维数组）
        return $this->pdo->fetchAll($sql);
    }
    public function delete($id)
    {
        //创建删除语句
        $sql = "DELETE FROM STUDENT WHERE id={$id}";
        //执行sql语句，返回结果
        return $this->pdo->exec($sql);
    }
}