<?php
require_once 'initialize.php';

// Check if required tables exist
$tables = ['yonghu', 'fangdong', 'siliao', 'jilu'];

echo "<h2>Checking required tables...</h2>";

foreach($tables as $table) {
    $result = db()->query("SHOW TABLES LIKE '" . $table . "'");
    if($result && db()->count($result) > 0) {
        echo "<p>✓ Table <strong>{$table}</strong> exists</p>";
        
        // Check fields
        $fields = db()->query("DESCRIBE {$table}");
        echo "<ul>";
        while($field = db()->fetch($fields)) {
            echo "<li>{$field['Field']} ({$field['Type']}) - {$field['Key']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>✗ Table <strong>{$table}</strong> does not exist</p>";
    }
}

// Test inserting a sample chat
echo "<h2>Testing chat functionality...</h2>";

// Try to create a sample chat if it doesn't exist
$propertyId = 1; // Using a default ID for testing
$landlordUsername = 'testuser'; // Using a default username for testing
$userId = 'testuser2'; // Using a default user for testing

// Check if there's an existing chat session between these two users
$existingChat = M("siliao")->where("
    (shouxinren='" . $landlordUsername . "' AND faxinren='" . $userId . "') 
    OR 
    (shouxinren='" . $userId . "' AND faxinren='" . $landlordUsername . "')"
)->find();

if(empty($existingChat)) {
    echo "<p>Creating a new chat session for testing...</p>";
    $sql = "INSERT INTO siliao (shouxinren, faxinren, addtime) VALUES ('" . $landlordUsername . "', '" . $userId . "', '" . date('Y-m-d H:i:s') . "')";
    $result = db()->query($sql);
    if($result) {
        $chatId = db()->insert_id();
        echo "<p>✓ Created new chat session with ID: {$chatId}</p>";
    } else {
        echo "<p>✗ Failed to create chat session</p>";
    }
} else {
    echo "<p>✓ Found existing chat session with ID: {$existingChat['id']}</p>";
    $chatId = $existingChat['id'];
}

// Check if tables have the required fields
echo "<h2>Verifying required fields...</h2>";

$requiredFields = [
    'yonghu' => ['yonghuming', 'touxiang'],
    'fangdong' => ['zhanghao', 'touxiang'],
    'siliao' => ['id', 'shouxinren', 'faxinren', 'addtime'],
    'jilu' => ['siliaoid', 'neirong', 'fasongren', 'cx', 'addtime']
];

$allGood = true;

foreach($requiredFields as $table => $fields) {
    echo "<h3>Checking table: {$table}</h3>";
    foreach($fields as $field) {
        $result = db()->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'");
        if($result && db()->count($result) > 0) {
            echo "<p>✓ Field <strong>{$field}</strong> exists in {$table}</p>";
        } else {
            echo "<p>✗ Field <strong>{$field}</strong> does NOT exist in {$table}</p>";
            $allGood = false;
        }
    }
}

if($allGood) {
    echo "<h3 style='color: green;'>✓ All required tables and fields are present!</h3>";
    echo "<p>You can now use the chat functionality.</p>";
} else {
    echo "<h3 style='color: red;'>✗ Some required tables or fields are missing!</h3>";
}