<?php
require_once 'initialize.php';

echo "测试M函数操作<br>";

// 测试jilu表的基本查询
try {
    echo "测试M('jilu')->select()...<br>";
    $result = M('jilu')->select();
    echo "M('jilu')->select() 成功，返回 " . count($result) . " 条记录<br>";
} catch (Exception $e) {
    echo "M('jilu')->select() 失败: " . $e->getMessage() . "<br>";
}

// 测试带条件的查询
try {
    echo "测试M('jilu')->where('siliaoid', 1)->select()...<br>";
    $result = M('jilu')->where('siliaoid', 1)->select();
    echo "M('jilu')->where('siliaoid', 1)->select() 成功<br>";
} catch (Exception $e) {
    echo "M('jilu')->where('siliaoid', 1)->select() 失败: " . $e->getMessage() . "<br>";
}

// 测试直接使用db()方法
try {
    echo "测试db()->select('SELECT * FROM jilu LIMIT 1')...<br>";
    $result = db()->select("SELECT * FROM jilu LIMIT 1");
    echo "db()->select成功<br>";
} catch (Exception $e) {
    echo "db()->select失败: " . $e->getMessage() . "<br>";
}

echo "测试完成<br>";
?>