<?php /**
 *   用户模块的操作文件
 */
require_once 'initialize.php';


$module = 'yonghu';  // 模块的表名称
$action = !empty($_REQUEST['a']) ? trim($_REQUEST['a']) : '';



if($action == 'insert'){  // 执行插入操作
    $ext = array();  // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

                                                                                                                                                                                            




    $charuid = saveData($module , $ext);  // saveData 方法在 include/common.php 文件中
    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('用户', '新增', '用户名：".$_POST["yonghuming"]."<br>姓名：".$_POST["xingming"]."<br>手机：".$_POST["shouji"]."<br>邮箱：".$_POST["youxiang"]."<br>年龄：".$_POST["nianling"]."<br>身份证：".$_POST["shenfenzheng"]."<br>所在城市：".$_POST["suozaichengshi"]."<br>学院/专业：".$_POST["xueyuanzhuanye"]."<br>国籍：".$_POST["guoji"]."<br>公区整洁期望：".$_POST["gongquzhengjieqiwang"]."<br>过敏/禁忌：".$_POST["guominjinji"]."<br>押金与损耗处理规则：".$_POST["yajinyusunhaochuliguize"]."<br>性格：".$_POST["xingge"]."<br>兴趣：".$_POST["xingqu"]."<br>作息：".$_POST["zuoxi"]."<br>活动：".$_POST["huodong"]."<br>理想室友特质：".$_POST["lixiangshiyoutezhi"]."<br>其他需求：".$_POST["qitaxuqiu"]."', '".$_SESSION["cx"]."', '".$_SESSION["username"]."')");


    if(isAjax()){
        showSuccess(M('yonghu')->find($charuid));
    }

    // 获取跳转地址         如果有条件指定地址      跳转到指定地址          否则跳转回添加页面
    $location = isset($_POST['referer']) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];

    showMessage('保存成功' , $location);  // 弹出保存成功  并跳转到location 中

}else if($action == 'update'){  // 执行更新操作

    $ext = array(); // 设定扩展参数
    $_REQUEST['f'] = true;  // 让 saveData 运行起来,按ctrl + 鼠标左键saveData 方法就能跳到指定文件

                                                                                                                                                                                            



    $charuid = saveData($module , $ext);  // saveData 方法在 include/common.php 文件中

    db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('用户', '更新', '用户名：".$_POST["yonghuming"]."<br>姓名：".$_POST["xingming"]."<br>手机：".$_POST["shouji"]."<br>邮箱：".$_POST["youxiang"]."<br>年龄：".$_POST["nianling"]."<br>身份证：".$_POST["shenfenzheng"]."<br>所在城市：".$_POST["suozaichengshi"]."<br>学院/专业：".$_POST["xueyuanzhuanye"]."<br>国籍：".$_POST["guoji"]."<br>公区整洁期望：".$_POST["gongquzhengjieqiwang"]."<br>过敏/禁忌：".$_POST["guominjinji"]."<br>押金与损耗处理规则：".$_POST["yajinyusunhaochuliguize"]."<br>性格：".$_POST["xingge"]."<br>兴趣：".$_POST["xingqu"]."<br>作息：".$_POST["zuoxi"]."<br>活动：".$_POST["huodong"]."<br>理想室友特质：".$_POST["lixiangshiyoutezhi"]."<br>其他需求：".$_POST["qitaxuqiu"]."', '".$_SESSION["cx"]."', '".$_SESSION["username"]."')");


    if(isAjax()){
        showSuccess(M('yonghu')->find($charuid));
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
        db()->query("INSERT INTO logs(module, operationtype, operationcontent, cx, username) VALUES ('用户', '删除', '用户名：".$map["yonghuming"]."<br>姓名：".$map["xingming"]."<br>手机：".$map["shouji"]."<br>邮箱：".$map["youxiang"]."<br>年龄：".$map["nianling"]."<br>身份证：".$map["shenfenzheng"]."<br>所在城市：".$map["suozaichengshi"]."<br>学院/专业：".$map["xueyuanzhuanye"]."<br>国籍：".$map["guoji"]."<br>公区整洁期望：".$map["gongquzhengjieqiwang"]."<br>过敏/禁忌：".$map["guominjinji"]."<br>押金与损耗处理规则：".$map["yajinyusunhaochuliguize"]."<br>性格：".$map["xingge"]."<br>兴趣：".$map["xingqu"]."<br>作息：".$map["zuoxi"]."<br>活动：".$map["huodong"]."<br>理想室友特质：".$map["lixiangshiyoutezhi"]."<br>其他需求：".$map["qitaxuqiu"]."', '".$_SESSION["cx"]."', '".$_SESSION["username"]."')");

    }

    $location = $_SERVER['HTTP_REFERER']; // 设置跳转回上一页
    showMessage('保存成功' , $location);  // 弹出保存成功  并跳转到location 中
}


?>