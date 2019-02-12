<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/2/3
 * Time: 13:47
 */
namespace Frame\Vendor;
//包含原始的Smarty类; ./Frame/Vendor/Smarty-3.1.33/libs/Smarty.class.php
require_once(FRAME_PATH."Vendor".DS."smarty-3.1.33".DS."libs".DS."Smarty.class.php");     //
//定义自己的Smarty类,没有定义命名空间的东西，通常认为保存在根空间
final class Smarty extends \Smarty{

}
