<?php /**
 *   操作日志模块的操作文件
 */
require_once 'initialize.php';


$module = 'logs';  // 模块的表名称
$action = !empty($_REQUEST['a']) ? trim($_REQUEST['a']) : '';



if($action == 'insert'){  // 执行插入操作
    $ext = array();  // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

                        $ext["addtime"] = Info::getDateStr();





    $charuid = saveData($module , $ext);  // saveData 方法在 include/common.php 文件中
    
    if(isAjax()){
        showSuccess(M('logs')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址      跳转到指定地址          否则跳转回添加页面
    $location = isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];

    showMessage('保存成功' , $location);  // 弹出保存成功  并跳转到location 中

}else if($action == 'update'){  // 执行更新操作

    $ext = array(); // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

                        



    $charuid = saveData($module , $ext);  // saveData 方法在 include/common.php 文件中

    
    if(isAjax()){
        showSuccess(M('logs')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址                                    跳转到指定地址          跳转回更新页面
    $location = isset($_POST['referer']) && !empty($_POST['updtself']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];


    showMessage('保存成功' , $location);  // 弹出保存成功  并跳转到location 中

} else if ($action == 'delete'){ // 执行删除操作

    $id = intval($_REQUEST['id']);
    if($id){
        // 获取删除行
        $map = M($module)->find($id);
        M($module)->delete($id);
            }

    $location = $_SERVER['HTTP_REFERER']; // 设置跳转回上一页
    showMessage('保存成功' , $location);  // 弹出保存成功  并跳转到location 中
}
else if($action == 'batch'){
    if($_POST['delete']){ // 批量删除
        $ids = $_POST['ids'];  // 获取前台选择的复选框
        M($module)->where("id" , "in" , $ids)->delete();
    }
    $location = $_SERVER['HTTP_REFERER']; // 设置跳转回上一页
    showMessage('批量处理成功' , $location);  // 弹出保存成功  并跳转到location 中
}


?>