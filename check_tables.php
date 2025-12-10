<?php
require_once 'initialize.php';

echo "<h2>检查数据库表结构</h2>";

// 检查siliao表结构
echo "<h3>siliao表结构：</h3>";
$result = db()->query("DESCRIBE siliao");
if($result) {
    echo "<table border='1'>";
    echo "<tr><th>字段</th><th>类型</th><th>是否为空</th><th>键</th><th>默认值</th><th>额外</th></tr>";
    while($row = db()->fetch($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "无法获取siliao表结构<br>";
}

echo "<br><h3>jilu表结构：</h3>";
$result = db()->query("DESCRIBE jilu");
if($result) {
    echo "<table border='1'>";
    echo "<tr><th>字段</th><th>类型</th><th>是否为空</th><th>键</th><th>默认值</th><th>额外</th></tr>";
    while($row = db()->fetch($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "无法获取jilu表结构<br>";
}

echo "<br><h3>测试M函数插入数据</h3>";
$data = array(
    'neirong' => '测试消息',
    'fasongren' => 'test',
    'cx' => '用户',
    'addtime' => date('Y-m-d H:i:s')
);

// 先尝试查询是否能正常工作
echo "测试M('jilu')->select()...<br>";
try {
    $test = M('jilu')->select();
    echo "M('jilu')->select() 成功<br>";
} catch (Exception $e) {
    echo "M('jilu')->select() 失败: " . $e->getMessage() . "<br>";
}

?>