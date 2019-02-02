<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/1/23
 * Time: 21:40
 */
//声明命名空间
namespace Frame\Vendor;
use \PDO;
//定义最终的PDOWrapper
final class PDOWrapper{
    //私有的静态的保存U对象属性
    private $db_type;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $charset;
    private $pdo = NULL;

    //构造方法
    public function __construct()
    {
        $this->db_type = $GLOBALS['config']['db_type'];
        $this->db_host = $GLOBALS['config']['db_host'];
        $this->db_port = $GLOBALS['config']['db_port'];
        $this->db_name = $GLOBALS['config']['db_name'];
        $this->db_user = $GLOBALS['config']['db_user'];
        $this->db_pass = $GLOBALS['config']['db_pass'];
        $this->charset = $GLOBALS['config']['charset'];
        $this->connetDb(); // 创建PDO对象，连通数据库，连接MYSQL服务器
        $this->setErrorMode(); //设置PDO的错误模式
    }

    //私有的创建PDO对象
    private function connetDb()
    {
        try{
            $dsn = "{$this->db_type}:host={$this->db_host};port={$this->db_port};";
            $dsn.="dbname={$this->db_name};charset={$this->charset}";
            $this->pdo = new \PDO($dsn,$this->db_user,$this->db_pass);
        }catch(\PDOException $e)
        {
            echo "<h2>创建PDO对象出错</h2>";
            $this->showError($e);
        }

    }

    //私有的设置PDO错误模式的方法
    private function setErrorMode()
    {
        $this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,PDO::ERRMODE_EXCEPTION);
    }

    //私有的显示错误信息的方法
    private function showError($e)
    {
        echo "错误代码：".$e->getCode();
        echo "<br>错误行号".$e->getLine();
        echo "<br>错误文件".$e->getFile();
        echo "<br>错误信息".$e->getMessage();
        die();
    }

    //获取单行数据（一维数组）
    public function fetchOne($sql)
    {
        try{
            //执行sql语句
            $PDOStatemnet = $this->pdo->query($sql);
            //从结果集对象中取回一条记录
            return $PDOStatemnet->fetch(PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            echo "<h2>SQL语句存在问题</h2>";
            $this->showError($e);
        }

    }

    //获取多行数据（返回二维数组）
    public function fetchAll($sql)
    {
        try{
            //执行sql语句
            $PDOStatemnet = $this->pdo->query($sql);
            //从结果集对象返回一维数组
            return $PDOStatemnet->fetchAll(PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            echo "<h2>SQL语句存在问题</h2>";
            $this->showError($e);
        }
    }

    //获取记录数
    public function rowCount($sql)
    {
        try{
            //执行sql语句
            $PDOStatemnet = $this->pdo->query($sql);
            //从结果集对象返回一维数组
            return $PDOStatemnet->rowCount();
        }catch(\PDOException $e){
            echo "<h2>SQL语句存在问题</h2>";
            $this->showError($e);
        }
    }

    //公共的执行SQL语句的方法：insert，delete，update，set等
    public function exec($sql)
    {
        try{
            return $this->pdo->exec($sql);
        }catch(\PDOException $e){
            echo "<h2>SQL语句存在问题</h2>";
            $this->showError($e);
        }
    }


}