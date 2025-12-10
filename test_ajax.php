<?php require_once 'initialize.php'; 

// Test the AJAX endpoint
echo "<h2>Testing AJAX endpoints</h2>";

echo "<h3>Testing send_message endpoint:</h3>";
echo "<pre>";
var_dump($_REQUEST);
echo "</pre>";

if (isset($_REQUEST['action'])) {
    echo "Action: " . $_REQUEST['action'] . "<br>";
    if ($_REQUEST['action'] == 'test') {
        echo "Test endpoint working!<br>";
    }
}
echo "<br>Session username: " . ($_SESSION["username"] ?? 'Not set') . "<br>";
echo "Session cx: " . ($_SESSION["cx"] ?? 'Not set') . "<br>";

echo "<br><h3>To test the functionality:</h3>";
echo "<p>Try accessing: <code>ajax.php?action=send_message&siliaoid=1&neirong=test&fasongren=test&cx=用户</code></p>";
?>