<?php

/**
 * 生成验证码，使用了  gd2库 + session + 随机数
 *
 */

require_once 'initialize.php';

// 创建  class_captcha 类对象
$captch = new class_captcha();

// 生成 验证码图片和验证值、生成后返回验证值
$random = $captch->run();

// 将验证值写入 session 中，留待验证验证码时使用
$_SESSION['random'] = $random;

// 输出验证码
$captch->display();


