<?php
/**
 * 根据前台提交得ajax内容 返回相应相应数据
 */

// 捕获并隐藏错误，防止输出到响应
error_reporting(0); // 完全关闭错误输出
ini_set('display_errors', 0);
ini_set('log_errors', 1); // 启用错误日志

require_once 'ajax_init.php';

// 设置响应头为JSON格式
header('Content-Type: application/json');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$checktype = $_REQUEST['checktype'] ? $_REQUEST['checktype'] : $_REQUEST['a'];

// Handle chat functionality
if($action == 'send_message') {
    $siliaoid = intval($_REQUEST['siliaoid']);
    $neirong = trim($_REQUEST['neirong']);
    $fasongren = trim($_REQUEST['fasongren']);
    $cx = trim($_REQUEST['cx']);

    if(empty($neirong) || empty($fasongren) || empty($cx)) {
        // 清空缓冲区
        ob_clean();
        echo json_encode(['success' => false, 'message' => '参数不完整']);
        exit;
    }

    // Get the chat session info to get the bianhao
    $chatInfo = db()->find("SELECT bianhao FROM siliao WHERE id=" . $siliaoid);
    $bianhao = $chatInfo ? $chatInfo['bianhao'] : '';

    // 检查jilu表是否有bianhao字段
    $columns = db()->select("SHOW COLUMNS FROM jilu");
    $hasBianhao = false;
    foreach($columns as $col) {
        if($col['Field'] == 'bianhao') {
            $hasBianhao = true;
            break;
        }
    }

    // 构建SQL插入语句
    if($hasBianhao) {
        $sql = "INSERT INTO jilu (siliaoid, bianhao, neirong, fasongren, cx, addtime) VALUES ('" . $siliaoid . "', '" . addslashes($bianhao) . "', '" . addslashes($neirong) . "', '" . addslashes($fasongren) . "', '" . addslashes($cx) . "', '" . date('Y-m-d H:i:s') . "')";
    } else {
        $sql = "INSERT INTO jilu (siliaoid, neirong, fasongren, cx, addtime) VALUES ('" . $siliaoid . "', '" . addslashes($neirong) . "', '" . addslashes($fasongren) . "', '" . addslashes($cx) . "', '" . date('Y-m-d H:i:s') . "')";
    }

    $result = db()->query($sql);
    if($result) {
        // 清空缓冲区
        ob_clean();
        echo json_encode(['success' => true, 'message' => '消息发送成功']);
    } else {
        // For debugging - you can check the MySQL error
        $error = db()->error();
        // 清空缓冲区
        ob_clean();
        echo json_encode(['success' => false, 'message' => '消息发送失败: ' . $error]);
    }
    exit;
}

elseif($action == 'get_messages') {
    $siliaoid = intval($_REQUEST['siliaoid']);

    if(empty($siliaoid)) {
        // 清空缓冲区
        ob_clean();
        echo json_encode(['success' => false, 'message' => '参数不完整']);
        exit;
    }

    // 使用更安全的数据库操作
    $messages = db()->select("SELECT * FROM jilu WHERE siliaoid=" . $siliaoid . " ORDER BY id ASC");

    if($messages === false) {
        // For debugging
        $error = db()->error();
        // 清空缓冲区
        ob_clean();
        echo json_encode(['success' => false, 'message' => '获取消息失败: ' . $error]);
        exit;
    }

    $html = '';
    foreach($messages as $msg) {
        $isOwn = $msg['fasongren'] === $_SESSION["username"];
        $senderInfo = null;

        if($msg['cx'] === '用户') {
            $senderInfo = db()->find("SELECT * FROM yonghu WHERE yonghuming='" . $msg['fasongren'] . "'");
        } elseif($msg['cx'] === '房东') {
            $senderInfo = db()->find("SELECT * FROM fangdong WHERE zhanghao='" . $msg['fasongren'] . "'");
        }

        $avatar = '';
        $name = $msg['fasongren'];

        if($senderInfo) {
            if($msg['cx'] === '用户') {
                $avatar = $senderInfo['touxiang'];
                $name = $senderInfo['xingming'];
            } elseif($msg['cx'] === '房东') {
                $avatar = $senderInfo['touxiang'];
                $name = $senderInfo['xingming'];
            }
        }

        $html .= '<div style="' . ($isOwn ? 'margin-left: auto; text-align: right;' : 'margin-right: auto; text-align: left;') . ' margin-bottom: 15px; max-width: 100%;">';
        $html .= '<div style="display: flex; align-items: center; ' . ($isOwn ? 'justify-content: flex-end;' : 'justify-content: flex-start;') . ' margin-bottom: 5px;">';

        if(!$isOwn) {
            $html .= '<img src="' . ($avatar ? $avatar : 'images/default.gif') . '" alt="头像" style="width: 36px; height: 36px; border-radius: 50%; margin-right: 10px; object-fit: cover;">';
        }

        $html .= '<div style="display: flex; flex-direction: column; ' . ($isOwn ? 'align-items: flex-end;' : 'align-items: flex-start;') . '">';
        $html .= '<div style="font-weight: bold; font-size: 14px;">' . htmlspecialchars($name) . '</div>';
        $html .= '<div style="font-size: 12px; color: #999;">' . $msg['addtime'] . '</div>';
        $html .= '</div>';

        if($isOwn) {
            $html .= '<img src="' . ($avatar ? $avatar : 'images/default.gif') . '" alt="头像" style="width: 36px; height: 36px; border-radius: 50%; margin-left: 10px; object-fit: cover;">';
        }

        $html .= '</div>';
        $html .= '<div style="' . ($isOwn ? 'margin-left: auto; background-color: #007bff; color: white; border-radius: 18px 4px 18px 18px;' : 'margin-right: auto; background-color: white; border-radius: 4px 18px 18px 18px;') . ' padding: 10px 15px; max-width: 70%; display: inline-block; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">';
        $html .= htmlspecialchars($msg['neirong']);
        $html .= '</div>';
        $html .= '</div>';
    }

    // 清空缓冲区
    ob_clean();
    echo json_encode(['success' => true, 'html' => $html]);
    exit;
}

// 为了兼容原有功能，但确保返回JSON格式
// 检测是查询一行数据
if($checktype == "table"){
    // 根据表 获取一行数据
    $table = trim($_REQUEST['table']);
    $id    = intval($_REQUEST['id']);
    $row   = db()->find("SELECT * FROM ".$table." WHERE id=".$id);
    // 将数据转换成JSON 数据输出
    echo json_encode($row);
    exit;
}

// 检查是插入数据、查询表中是否有重复得数据
elseif($checktype == 'insert'){
    $table = trim($_REQUEST['table']);
    $col   = trim($_REQUEST['col']);
    $value = trim($_REQUEST[$col]);
    $count = db()->getOne("select count(*) from " . $table . " where " . $col . "='" . $value . "'");

    // 检查到表中有重复得，返回、false。没有返回为true
    if($count){
        die('false');
    }else{
        die('true');
    }
    exit;
}

// 检查是更新数据、查询表中是否有重复得数据
elseif($checktype == 'update'){
    $table = trim($_REQUEST['table']);
    $col   = trim($_REQUEST['col']);
    $value = trim($_REQUEST[$col]);
    $id    = trim($_REQUEST['id']);


    // 检查表中得数据，且不等于自己哪行数据
    $count = db()->getOne("select count(*) from " . $table . " where " . $col . "='" . $value . "' AND id!='{$id}'");

    // 检查到表中有重复得，返回、false。没有返回为true
    if($count){
        die('false');
    }else{
        die('true');
    }
    exit;
}

// 如果没有匹配到任何已知操作，返回错误
echo json_encode(['success' => false, 'message' => '未知操作']);
exit;
