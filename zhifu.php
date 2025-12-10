<?php //验证登陆信息
require_once 'initialize.php';
checkLogin($_SERVER['HTTP_REFERER']);


if(isset($_REQUEST['out_trade_no'])){
    list($bianhaoid , $biao , $id) = explode('-' , $_REQUEST['out_trade_no']);
}else{
    $id = $_REQUEST["id"];
    $biao = $_REQUEST['biao'];
}



$data = array(
    'iszf'=>'是',
    // 下面写入自己的参数格式：'字段名'=>'更新的值',
    // 写入方式如下：
    // 'dingdanzhuangtai'=>'已发货',
);
M($biao)->where('id',$id)->save($data);
$order = M($biao)->where('id',$id)->find();

$comewhere = !empty($_GET['referer']) ? $_GET['referer'] : 'sy.php';


echo "<script language='javascript'>alert('支付成功！');window.opener.location.reload();window.close();</script>";


