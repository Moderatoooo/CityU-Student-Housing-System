<?php

/**
 * 加载这个页面自动判断是否有登录，没登录则提示 登录超时 返回上一个页面
 */

if(empty($_SESSION['username'])){
    showMessage('对不起，您已超时或未登陆！');
}
