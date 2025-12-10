<?php
/**
 * 处理登录、批量删除、修改密码、加入收藏、一些不需要页面显示的内容
 */
require_once 'initialize.php';
$a = $_REQUEST['a'];

if($a == 'batch_delete'){  // 批量删除
    $table = trim($_REQUEST['table']);
    $ids   = $_REQUEST['ids'];
    if(is_array($ids)){
        $ids = implode(','  ,$ids);
    }
    if(!$ids){
        showMessage("没有找到相关ID");
    }
    db()->query("DELETE FROM {$table} WHERE id in({$ids})");
    showMessage('批量处理成功' , $_SERVER['HTTP_REFERER']);
}


// 处理登录

elseif($a == 'login' ){
    $username = trim($_POST['username']);  // 获取用户名
    $password = trim($_POST['pwd']);       // 获取密码
    $cx       = trim($_POST['cx']);        // 获取选择登录的权限
    $pagerandom = trim($_POST['pagerandom']);   // 获取验证码

    // 验证验证码是否正确
    if($pagerandom != $_SESSION['random'] && $_REQUEST['captch']){
        showMessage("验证码错误");
    }

    // 获取可登录的列表
    $list = include(INCLUDE_PATH . 'login_list.php');
    if(empty($list) || empty($list[$cx]) || !$list[$cx]['is_web']){
        showMessage('数据错误，提交信息有误');
    }

    //  将可登录的数据写入$login 变量
    $login = $list[$cx];

    // 设置条件 用户名
    $where[$login['username']] = $username;

    // 设置条件 密码
    $where[$login['password']] = $login['md5'] ? md5($password) : $password;

    // 设置 条件是否需要审核才能登录
    if($login['issh']){
        $where['issh'] = '是';
    }
    // 匹配数据库中的数据是否有匹配的，有则获取当前数据
    $row = M($login['table'])->where($where)->find();
    if(!$row){
        // 未匹配到相应数据，提示账号或密码错误
        showMessage('账号或密码错误');
    }

    //  将账号信息写入 session 中。
    $_SESSION['username'] = $row[$login['username']];
    $_SESSION['cx'] = $cx;
    $_SESSION['login'] = $cx;
    foreach($row as $key=>$val){
        $_SESSION[$key] = $val;
    }
    //  跳转到上一页
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
    //showMessage("登录成功" , $_SERVER['HTTP_REFERER']);
}

// 处理管理员登录
elseif($a == 'adminlogin'){  // 处理管理员登录
    $username = trim($_POST['username']);  // 获取用户名
    $password = trim($_POST['pwd']);       // 获取密码
    $cx       = trim($_POST['cx']);        // 获取选择登录的权限
    $pagerandom = trim($_POST['pagerandom']);  // 获取验证码

    // 验证验证码是否正确
    if($pagerandom != $_SESSION['random'] && $_REQUEST['captch']){
        showMessage("验证码错误");
    }
    // 获取可登录的列表
    $list = include(INCLUDE_PATH . 'login_list.php');
    if(empty($list) || empty($list[$cx]) || !$list[$cx]['is_admin']){
        showMessage('数据错误，提交信息有误');
    }

    //  将可登录的数据写入$login 变量
    $login = $list[$cx];

    // 设置条件 用户名
    $where[$login['username']] = $username;

    // 设置条件 密码
    $where[$login['password']] = $login['md5'] ? md5($password) : $password;

    // 设置 条件是否需要审核才能登录
    if($login['issh']){
        $where['issh'] = '是';
    }

    // 匹配数据库中的数据是否有匹配的，有则获取当前数据
    $row = M($login['table'])->where($where)->find();
    if(!$row){
        // 未匹配到相应数据，提示账号或密码错误
        showMessage('账号或密码错误');
    }
    //  将账号信息写入 session 中。
    $_SESSION['username'] = $row[$login['username']];
    $_SESSION['cx'] = $cx;
    $_SESSION['login'] = $cx;

    // 遍历表，然后将数据写入数据库中
    foreach($row as $key=>$val){
        $_SESSION[$key] = $val;
    }
    header("Location: main.php");
    //showMessage("登录成功" , 'main.php');
    exit;


}
//  处理修改密码，
elseif($a == 'adminuppass'){

    $ymm = trim($_REQUEST['ymm']);   // 获取原密码
    $xmm1 = trim($_REQUEST['xmm1']); // 获取新密码
    $xmm2 = trim($_REQUEST['xmm2']); // 获取确认密码

    if($xmm1 != $xmm2){  // 检测两次密码是否一致，不一致则弹出密码不一致
        showMessage('新密码和确认密码不一致');  // 弹出不一致
    }

    // 获取可登录的列表
    $list = include(INCLUDE_PATH . 'login_list.php');

    // 获取当前登录类型
    $cx = $_SESSION['login'];


    //  将可登录的数据写入$login 变量
    $login = $list[$cx];
    // 设置条件  用户名
    $where[$login['username']] = $_SESSION['username'];

    //  设置条件 原密码
    $where[$login['password']] = $login['md5'] ? md5($ymm) : $ymm;

    // 与数据库中原来原来得密码进行匹配，是否正确
    $row = M($login['table'])->where($where)->find();
    if(!$row){
        // 不正确，则提示 原密码不正确
        showMessage('原密码不正确');
    }

    // 修改成新密码
    $row[$login['password']] = $login['md5'] ? md5($xmm1) : $xmm1;

    // 保存到新密码中
    M($login['table'])->save($row);
    // 提示修改密码成功
    showMessage('修改密码成功');


}

// 写入收藏内容
elseif($a == 'jrsc'){
    // 检测是否登录，没登录则提示未登录，然后跳转到上一页中
    checkLogin($_SERVER['HTTP_REFERER']);

    $id = $_REQUEST['id'];  //  获取对应表得id
    $biao  = $_REQUEST['biao'];   // 获取对应表名称，
    $ziduan = $_REQUEST['ziduan'];  // 获取对应表 字段名
    $row = M($biao)->where('id',$id)->find();   //  根据表获取 和 id 获取一行数据
    $biaoti = $row[$ziduan];  // 将要显示得字段值写入到表中

    $dat = array(
        'xwid'=>$id,  // 写入 对应表 id
        'biao'=>$biao,  // 写入对应表名称
        'ziduan'=>$ziduan,   // 写入对应表字段名
        'biaoti'=>$biaoti,   // 写入要显示对应表得显示标题
        'url'=>$_SERVER['HTTP_REFERER'],   // 写入上一页得内容
        'username'=>$_SESSION['username']   // 写入当前登录用户名
    );
    M('shoucangjilu')->add($dat);   // 写入收藏表
    showMessage("加入收藏成功");
}
// 退出登录
elseif( $a == 'logout' ){
    $_SESSION = array();
    showMessage("退出成功" , 'index.php');
}
// 根据表，设置是否审核， 将否 改为 是
elseif($a == 'sh'){

    //       构建  M（表）
    $query = M($_REQUEST['tablename']);

    //  获取当前值
    $yuan  = trim($_REQUEST['yuan']);

    //  更新 是 或 否
    $query->where($query->getPk() , $_REQUEST['id'])->save(
        array('issh'=>$yuan=='是'?'否':'是')
    );
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

// 根据条件获取多行数据
elseif($a == 'selectUpdate'){
    // 下拉更新搜索
    $table = $_REQUEST['table'];
    $query = M($table);  // 构建表

    // 将前台提交得json 数据解码
    $where = json_decode($_REQUEST['where'] , 1);
    $limit = 50;
    // 遍历提交得参数
    foreach($where as $key=>$value)
    {
        // 判断值是否为数组
        if($key == 'limit'){
            $limit = $value;
        }
        else if(is_array($value)){
            if(isset($value['exp'])){
                $query->where($key , $value['exp'] , $value['value']);
            }else{
                $query->where($key , $value[0] , $value[1]);
            }
        }else{
            $query->where($key,$value);
        }
    }

    // 获取数据
    $list = $query->order('id desc')->limit($limit)->select();
    // 输出 json 数据
    echo json_encode($list);
}else if($a == 'commit'){
    // 处理评论
    checkLogin($_SERVER['HTTP_REFERER']);
    M('pinglun')->add($_POST);
    showMessage('评论成功');

}







