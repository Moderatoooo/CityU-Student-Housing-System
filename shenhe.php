<?php /**
 *   审核模块的操作文件
 */
require_once 'initialize.php';


$module = 'shenhe';  // 模块的表名称
$action = !empty($_REQUEST['a']) ? trim($_REQUEST['a']) : '';


if ($action == 'insert') {  // 执行插入操作
    $ext = array();  // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

    $ext["addtime"] = Info::getDateStr();


    $charuid = saveData($module, $ext);  // saveData 方法在 include/common.php 文件中
    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('审核', '新增', '租赁单号：" . $_POST["zulindanhao"] . "<br>房屋编号：" . $_POST["fangwubianhao"] . "<br>房屋标题：" . $_POST["fangwubiaoti"] . "<br>房屋户型：" . $_POST["fangwuhuxing"] . "<br>小区名称：" . $_POST["xiaoqumingcheng"] . "<br>姓名：" . $_POST["xingming"] . "<br>联系电话：" . $_POST["lianxidianhua"] . "<br>身份证号：" . $_POST["shenfenzhenghao"] . "<br>审核备注：" . $_POST["shenhebeizhu"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");
    db()->query("UPDATE zulin SET zulinzhuangtai = '" . $_POST["shenhe"] . "' WHERE id='" . $_POST["zulinid"] . "'");
    if ($_POST["zulinleixing"] == '整租')
    {
        db()->query("UPDATE fangwuxinxi SET fangwuzhuangtai = '已租' WHERE fangwubianhao='" . $_POST["fangwubianhao"] . "' AND '" . $_POST["shenhe"] . "'='通过' ");
        db()->query("UPDATE fangjianxinxi SET zhuangtai = '已租' WHERE fangwubianhao='" . $_POST["fangwubianhao"] . "' AND '" . $_POST["shenhe"] . "'='通过'");

    }else{
        db()->query("UPDATE fangjianxinxi SET zhuangtai = '已租' WHERE id='" . $_POST["xuanzefangjian"] . "'  AND '" . $_POST["shenhe"] . "'='通过'");

    }



     $fw = M("fangjianxinxi")->where("fangwubianhao", $_POST["fangwubianhao"])->where("zhuangtai", "待租")->field("count(*) as count")->find();

     if ($fw["count"] <= 0 AND $_POST["shenhe"]='通过' ){
         db()->query("UPDATE fangwuxinxi SET fangwuzhuangtai = '已租' WHERE fangwubianhao='" . $_POST["fangwubianhao"] . "' AND '" . $_POST["zulinleixing"] . "'='分租'");

     }


    if (isAjax()) {
        showSuccess(M('shenhe')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址      跳转到指定地址          否则跳转回添加页面
    $location = isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];

    showMessage('保存成功', $location);  // 弹出保存成功  并跳转到location 中

} else if ($action == 'update') {  // 执行更新操作

    $ext = array(); // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件


    $charuid = saveData($module, $ext);  // saveData 方法在 include/common.php 文件中

    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('审核', '更新', '租赁单号：" . $_POST["zulindanhao"] . "<br>房屋编号：" . $_POST["fangwubianhao"] . "<br>房屋标题：" . $_POST["fangwubiaoti"] . "<br>房屋户型：" . $_POST["fangwuhuxing"] . "<br>小区名称：" . $_POST["xiaoqumingcheng"] . "<br>姓名：" . $_POST["xingming"] . "<br>联系电话：" . $_POST["lianxidianhua"] . "<br>身份证号：" . $_POST["shenfenzhenghao"] . "<br>审核备注：" . $_POST["shenhebeizhu"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");


    if (isAjax()) {
        showSuccess(M('shenhe')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址                                    跳转到指定地址          跳转回更新页面
    $location = isset($_POST['referer']) && !empty($_POST['updtself']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];


    showMessage('保存成功', $location);  // 弹出保存成功  并跳转到location 中

} else if ($action == 'delete') { // 执行删除操作

    $id = intval($_REQUEST['id']);
    if ($id) {
        // 获取删除行
        $map = M($module)->find($id);
        M($module)->delete($id);
        db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('审核', '删除', '租赁单号：" . $map["zulindanhao"] . "<br>房屋编号：" . $map["fangwubianhao"] . "<br>房屋标题：" . $map["fangwubiaoti"] . "<br>房屋户型：" . $map["fangwuhuxing"] . "<br>小区名称：" . $map["xiaoqumingcheng"] . "<br>姓名：" . $map["xingming"] . "<br>联系电话：" . $map["lianxidianhua"] . "<br>身份证号：" . $map["shenfenzhenghao"] . "<br>审核备注：" . $map["shenhebeizhu"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");

    }

    $location = $_SERVER['HTTP_REFERER']; // 设置跳转回上一页
    showMessage('保存成功', $location);  // 弹出保存成功  并跳转到location 中
}


?>