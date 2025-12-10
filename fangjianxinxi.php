<?php /**
 *   房间信息模块的操作文件
 */
require_once 'initialize.php';


$module = 'fangjianxinxi';  // 模块的表名称
$action = !empty($_REQUEST['a']) ? trim($_REQUEST['a']) : '';


if ($action == 'insert') {  // 执行插入操作
    $ext = array();  // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

    $ext["fangjianxiangqing"] = class_download::getContent($_POST["fangjianxiangqing"]);


    $charuid = saveData($module, $ext);  // saveData 方法在 include/common.php 文件中
    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('房间信息', '新增', '房屋标题：" . $_POST["fangwubiaoti"] . "<br>小区名称：" . $_POST["xiaoqumingcheng"] . "<br>房屋户型：" . $_POST["fangwuhuxing"] . "<br>楼层：" . $_POST["louceng"] . "<br>房间名称：" . $_POST["fangjianmingcheng"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");

    db()->query("UPDATE fangwuxinxi SET fangwuzhuangtai = '待租' WHERE id='" . $_POST["fangwuxinxiid"] . "' AND '" . $_POST["zulinleixing"] . "' = '分租'");


    if (isAjax()) {
        showSuccess(M('fangjianxinxi')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址      跳转到指定地址          否则跳转回添加页面
    $location = isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];

    showMessage('保存成功', $location);  // 弹出保存成功  并跳转到location 中

} else if ($action == 'update') {  // 执行更新操作

    $ext = array(); // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

    $ext["fangjianxiangqing"] = class_download::getContent($_POST["fangjianxiangqing"]);


    $charuid = saveData($module, $ext);  // saveData 方法在 include/common.php 文件中

    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('房间信息', '更新', '房屋标题：" . $_POST["fangwubiaoti"] . "<br>小区名称：" . $_POST["xiaoqumingcheng"] . "<br>房屋户型：" . $_POST["fangwuhuxing"] . "<br>楼层：" . $_POST["louceng"] . "<br>房间名称：" . $_POST["fangjianmingcheng"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");


    if (isAjax()) {
        showSuccess(M('fangjianxinxi')->find($charuid));
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
        db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('房间信息', '删除', '房屋标题：" . $map["fangwubiaoti"] . "<br>小区名称：" . $map["xiaoqumingcheng"] . "<br>房屋户型：" . $map["fangwuhuxing"] . "<br>楼层：" . $map["louceng"] . "<br>房间名称：" . $map["fangjianmingcheng"] . "', '" . $_SESSION["cx"] . "', '" . $_SESSION["username"] . "')");

    }

    $location = $_SERVER['HTTP_REFERER']; // 设置跳转回上一页
    showMessage('保存成功', $location);  // 弹出保存成功  并跳转到location 中
}


?>