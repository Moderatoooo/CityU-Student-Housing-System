<?php



/**
 * 将转义数据，转换回正常数据
 * Enter description here ...
 * @param $string
 */
function dstripslashes($string) {
    if(empty($string)) return $string;
    if(is_array($string)) {
        foreach($string as $key => $val) {
            $string[$key] = dstripslashes($val);
        }
    } else {
        $string = stripslashes($string);
    }
    return $string;
}

function param($name , $default = '')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
}

/**
 * 设置session，和获取session 的值
 * @param string $name session 名称
 * @param mixed $value  session 值、空字符串代表获取数据, null代表删除session
 * @return mixed|string|true
 */
function session($name, $value = '')
{
    if($value !== '' && $value !== null){
        $_SESSION[$name] = $value;
        return $value;
    }elseif($value === null){
        unset($_SESSION[$name]);
        return true;
    }else{
        return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
    }
}


/**
 * 自动加载类
 * Enter description here ...
 * @param string $class
 *
 */
function loadclass($class ){
    //echo $class."\r\n";
    //$class = strtolower($class);
    $file = strtr($class , '_','/').'.php';
    // 检查工程目录下是否有此文件，有则使用

    $path = INCLUDE_PATH . $file;

    if(file_exists($path)){
        include $path;
    }else{
        die($path);
        return false;
        //Exce_error('Not Class '.$class);
    }
}

/**
 * 获取 class_mysql 类，并链接数据库
 * @return class_mysql
 */
function db()
{
    static $db = null;
    if($db === null){
        $config = include(ROOT_PATH . 'conn.php');
        $db = new class_mysql($config);
    }
    return $db;
}


/**
 * @name 取随机字符串
 * Enter description here ...
 * @param int $length
 * @return string 返回指定长度的随机文本
 */
function random($length) {
    $hash = '';
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($chars) - 1;
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}


/**
 * 判断是否为ajax 提交
 * @return bool
 */
function isAjax()
{
    return strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == strtolower('XMLHttpRequest');
}


/**
 * 弹出提示窗，并跳转到 url 指定位置，默认为上一页不刷新
 * @param mixed $msg
 * @param string $url
 * @param int $code
 */
function showMessage( $msg , $url = 'javascript:history.go(-1)' , $code = 0)
{
    if(isAjax()){
        header("Content-Type: application/json");
        $map = array(
            'code'=>$code
        );
        if($code == 0){
            $map['data'] = $msg;
            $map['msg'] = '';
        }else{
            $map['data'] = '';
            $map['msg'] = $msg;
        }
        $map['href'] = $url;
        echo json_encode($map);
        exit;
    }

    echo "<script>alert('".str_replace(array("'","\n","\r"),array("\\'",'\\n','\\r'),$msg)."');";
    if(stripos($url , 'javascript:')!==false){
        echo substr($url , strlen("javascript:"));
    }else{
        echo 'location.href="'.$url.'"';
    }
    echo "</script>";
    exit;
}

function showSuccess($data , $url = null)
{
    $url = $url ? $url : $_SERVER['HTTP_REFERER'];
    showMessage($data,$url,0);
}

function showError($msg, $url = 'javascript:history.go(-1)', $code = 1)
{
    showMessage($msg , $url,$code);
}


/**
 * 创建数据表模型操作
 * @param $name
 * @return class_model
 */
function M($name)
{
    return new class_model($name , db());
}



/**
 *  生成指定目录不重名的文件名
 *
 * @access  public
 * @param   string      $dir        要检查是否有同名文件的目录
 *
 * @return  string      文件名
 */
function getSaveName($file)
{
    $dir = $file['savepath'];
    $ext = $file['extension'];

    $filename = '';
    while (empty($filename))
    {
        $filename = random_filename();
        if (file_exists($dir . $filename . '.'.$ext))
        {
            $filename = '';
        }
    }
    return $filename;
}
/**
 * 生成随机的数字串
 *
 * @author: weber liu
 * @return string
 */
function random_filename()
{
    $str = '';
    for($i = 0; $i < 6; $i++)
    {
        $str .= mt_rand(0, 9);
    }
    return date('mdHis') . $str;
}



/**
 * @name 格式化字节数
 * Enter description here ...
 * @param string $val 多少M 或 多少G 或多少 k
 * @return int
 */
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        case 'g': $val *= 1024;
        case 'm': $val *= 1024;
        case 'k': $val *= 1024;
    }
    return $val;
}


/**
 * 将字节转成可阅读格式
 *
 * @access  public
 * @param int $num
 *
 * @return string
 */
function byte_format($num)
{
    $bitunit = array(' B',' KB',' MB',' GB');
    for ($key = 0, $count = count($bitunit); $key < $count; $key++)
    {
        if ($num >= pow(2, 10 * $key) - 1) // 1024B 会显示为 1KB
        {
            $num_bitunit_str = (ceil($num / pow(2, 10 * $key) * 100) / 100) . " $bitunit[$key]";
        }
    }
    return $num_bitunit_str;
}

/**
 * 检测是否登录
 * @param string $url
 */
function checkLogin( $url = '' )
{
    $url = $url ? $url : ($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] :  './');
    if(empty($_SESSION['username'])){
        showMessage("对不起，您已超时或未登陆！" , $url);
    }
}

/**
 * 根据表删除数据
 * @param $tableName
 */
function deleteData( $tableName )
{
    // 检测是否有提交 scid 参数，有则删除数据
    if(isset($_REQUEST['scid']) && intval($_REQUEST['scid'])){
        if(is_array($_REQUEST['scid'])){  // 判断是否为 数组，是数组,则按数组方式删除

            // M(表名称)->设置条件（id ,'in' , 数组）->delete(); 执行删除
            M($tableName)->where('id' ,"in", $_REQUEST['scid'])->delete();
        }else{
            // 非数组
            // M（表名称）->delete(执行删除一行id);
            M($tableName)->delete($_REQUEST['scid']);
        }
    }
}

/**
 * 添加或者更新 表数据
 *
 * @param $table  表名称
 * @param array $ext   扩展参数
 * @return bool    // 返回 更新后的 id值
 */
function saveData($table , $ext = array())
{
    // 判断是否点击提交按钮，是则执行里面的代码
    if(isset($_REQUEST['f'])){

        //  构建一个表结构
        $query = M($table);

        // 合并 表单填写的参数 和 $ext 数组
        $post = array_merge($_REQUEST , $ext);

        //  检测是否为数组，是数组 则将值用“,”逗号隔开
        foreach ($post as $k=>$v){
            if(is_array($v)){
                $post[$k] = implode(',' , $v);
            }
        }

        // 判断是否为更新
        if(!empty($post[$query->getPk()])){

            // 是更新数据，让表结构

            $query->save($post);
            return $post[$query->getPk()];  // 返回 id 值
        }else{
            if(isset($post[$query->getPk()])){ // 如果定义了id 但是值为假，也就是为0，false、null 这些
                unset($post[$query->getPk()]); // 那么就把注销掉，不需要带上这个值
            }
            return $query->add($post);  // 执行插入数据并返回 插入的id 值
        }
    }
    return false;
}

/**
 * 将ip转换成数字，方便保存在数据库
 * Enter description here ...
 * @param $ip
 */
function iptolong($ip){
    return sprintf('%u',ip2long($ip));
}

/**
 * 获得用户的真实IP地址
 *
 * @access  public
 * @return  string
 */
function real_ip($is_long = false)
{
    static $ip = NULL;
    if ($ip !== NULL)
    {
        return $is_long ? iptolong($ip) : $ip;
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] AS $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    return $is_long ? iptolong($ip) : $ip;
}



