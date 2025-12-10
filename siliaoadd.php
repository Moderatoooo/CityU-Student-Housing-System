<?php require_once 'initialize.php'; 

// Check if user is logged in
if(empty($_SESSION["username"]) || $_SESSION["username"] == "") {
    header("Location: login.php");
    exit;
}

// Get parameters
$propertyId = isset($_GET['id']) ? $_GET['id'] : 0;
$landlordUsername = isset($_GET['shouxinren']) ? $_GET['shouxinren'] : '';
$chatId = isset($_GET['chatid']) ? $_GET['chatid'] : 0;

// If we have a specific chat ID, use that
if($chatId) {
    // Load existing chat
    $existingChat = M("siliao")->where("id", $chatId)->find();
    if($existingChat) {
        // Determine the other participant in the chat
        $otherUser = $existingChat['shouxinren'] === $_SESSION["username"] ? 
            $existingChat['faxinren'] : $existingChat['shouxinren'];
        $landlordUsername = $otherUser;
        $chatId = $existingChat['id'];
        
        // Try to find the property associated with the first message in this chat
        // as a way to identify which property this chat is about
        if (!$propertyId) {
            $firstMessage = M("jilu")->where("siliaoid", $chatId)->order("id asc")->find();
            if ($firstMessage) {
                // We can try to extract property info from the first message content if needed
                // Or check if there's any other way to link to property
            }
        }
    } else {
        // Invalid chat ID, redirect or show error
        header("Location: chats.php");
        exit;
    }
} else {
    // Check if there's an existing chat session between these two users
    $existingChat = M("siliao")->where("
        (shouxinren='" . $_SESSION["username"] . "' AND faxinren='" . $landlordUsername . "') 
        OR 
        (shouxinren='" . $landlordUsername . "' AND faxinren='" . $_SESSION["username"] . "')"
    )->find();

    if(empty($existingChat)) {
        // Create new chat session with auto-generated bianhao
        $bianhao = 'CHAT_' . date('Ymd') . '_' . time() . '_' . rand(1000, 9999);
        // If we have property information, use it as the title; otherwise use a default title
        $title = $propertyInfo ? $propertyInfo['fangwubiaoti'] : '与' . $landlordUsername . '的聊天';
        
        // Prepare data to insert
        $chatData = array(
            'bianhao' => $bianhao,
            'biaoti' => $title,
            'shouxinren' => $landlordUsername,
            'faxinren' => $_SESSION["username"],
            'addtime' => date('Y-m-d H:i:s')
        );
        
        // Use system native method to insert data
        $chatId = M('siliao')->add($chatData);
    } else {
        $chatId = $existingChat['id'];
    }
}

// Get the other participant info for displaying in chat header
// First determine who the other participant is based on the current session user
$otherUser = $landlordUsername;  // This is the other participant

// Check both user and landlord tables to find the other participant
$otherUserInfo = M("yonghu")->where("yonghuming", $otherUser)->find();
$otherLandlordInfo = M("fangdong")->where("zhanghao", $otherUser)->find();

// Use the one that exists
if($otherUserInfo) {
    $otherParticipantInfo = $otherUserInfo;
    $otherParticipantName = $otherUserInfo['xingming'];
    $otherParticipantAvatar = $otherUserInfo['touxiang'];
    $otherParticipantRole = '用户';
} elseif($otherLandlordInfo) {
    $otherParticipantInfo = $otherLandlordInfo;
    $otherParticipantName = $otherLandlordInfo['xingming'];
    $otherParticipantAvatar = $otherLandlordInfo['touxiang'];
    $otherParticipantRole = '房东';
} else {
    // Fallback if user not found
    $otherParticipantInfo = null;
    $otherParticipantName = $otherUser;
    $otherParticipantAvatar = '';
    $otherParticipantRole = '';
}

// Update the variable names to be more generic for the chat header
$oppositeUserInfo = $otherParticipantInfo;
$oppositeUserName = $otherParticipantName;
$oppositeUserAvatar = $otherParticipantAvatar;
$oppositeUserRole = $otherParticipantRole;

// For the current logged-in user
$currentUserInfo = M("yonghu")->where("yonghuming", $_SESSION["username"])->find();
if (!$currentUserInfo) {
    $currentUserInfo = M("fangdong")->where("zhanghao", $_SESSION["username"])->find();
}
$currentAvatar = $currentUserInfo ? (isset($currentUserInfo['touxiang']) ? $currentUserInfo['touxiang'] : '') : '';

// Get property info if property ID is provided
$propertyInfo = null;
if($propertyId) {
    $propertyInfo = M("fangwuxinxi")->where("id", $propertyId)->find();
}
?>

<?php include "head.php" ?>
<?php include "header.php" ?>

<div style="max-width: 800px; margin: 20px auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; min-height: 500px; display: flex; flex-direction: column;">

    <div style="background-color: #007bff; color: white; padding: 15px 20px; display: flex; align-items: center;">
        <img src="<?php echo $oppositeUserAvatar ? $oppositeUserAvatar : 'images/default.gif'; ?>" alt="头像" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 15px; object-fit: cover;">
        <div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo $oppositeUserName; ?></div>
            <div style="font-size: 14px; opacity: 0.9;"><?php echo $oppositeUserRole; ?></div>
        </div>
    </div>
    
    <div id="chatMessages" style="flex: 1; padding: 20px; overflow-y: auto; background-color: #f0f4f8; min-height: 300px;">
        <!-- Property info if available -->
        <?php if($propertyInfo): ?>
<!--        <div style="background-color: #e9f4ff; padding: 15px; border-radius: 8px; margin-bottom: 15px;">-->
<!--            <div style="font-weight: bold; font-size: 16px;">--><?php //echo $propertyInfo['fangwubiaoti']; ?><!--</div>-->
<!--            <div style="font-size: 14px; color: #666;">-->
<!--                租金:--><?php //echo $propertyInfo['fangwuzujin']; ?><!--/月 | <span style="color:#0ac265;">--><?php //echo $propertyInfo['zulinleixing']; ?><!--</span>-->
<!--            </div>-->
<!--        </div>-->
        <?php endif; ?>
        
        <!-- Messages will be loaded here -->
        <?php
        $messages = M("jilu")->where("siliaoid", $chatId)->order("id asc")->select();
        foreach($messages as $msg) {
            $isOwn = $msg['fasongren'] === $_SESSION["username"];
            $senderInfo = null;
            
            if($msg['cx'] === '用户') {
                $senderInfo = M("yonghu")->where("yonghuming", $msg['fasongren'])->find();
            } elseif($msg['cx'] === '房东') {
                $senderInfo = M("fangdong")->where("zhanghao", $msg['fasongren'])->find();
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
        ?>
            <div style="<?php echo $isOwn ? 'margin-left: auto; text-align: right;' : 'margin-right: auto; text-align: left;'; ?> margin-bottom: 15px; max-width: 100%;">
                <div style="display: flex; align-items: center; <?php echo $isOwn ? 'justify-content: flex-end;' : 'justify-content: flex-start;'; ?> margin-bottom: 5px;">
                    <?php if(!$isOwn): ?>
                        <img src="<?php echo $avatar ? $avatar : 'images/default.gif'; ?>" alt="头像" style="width: 36px; height: 36px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                    <?php endif; ?>
                    <div style="display: flex; flex-direction: column; <?php echo $isOwn ? 'align-items: flex-end;' : 'align-items: flex-start;'; ?>">
                        <div style="font-weight: bold; font-size: 14px;"><?php echo htmlspecialchars($name); ?></div>
                        <div style="font-size: 12px; color: #999;"><?php echo $msg['addtime']; ?></div>
                    </div>
                    <?php if($isOwn): ?>
                        <img src="<?php echo $avatar ? $avatar : 'images/default.gif'; ?>" alt="头像" style="width: 36px; height: 36px; border-radius: 50%; margin-left: 10px; object-fit: cover;">
                    <?php endif; ?>
                </div>
                <div style="<?php echo $isOwn ? 'margin-left: auto; background-color: #007bff; color: white; border-radius: 18px 4px 18px 18px;' : 'margin-right: auto; background-color: white; border-radius: 4px 18px 18px 18px;'; ?> padding: 10px 15px; max-width: 70%; display: inline-block; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                    <?php echo htmlspecialchars($msg['neirong']); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <div style="display: flex; padding: 15px; background-color: white; border-top: 1px solid #eee;">
        <textarea id="messageInput" placeholder="输入消息..." style="flex: 1; padding: 10px 15px; border: 1px solid #ddd; border-radius: 20px; resize: none; height: 40px; max-height: 100px; overflow-y: auto;"></textarea>
        <button id="sendMessageBtn" style="margin-left: 10px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 20px; cursor: pointer;">发送</button>
    </div>
</div>

<script>
// Wait for window to load to ensure jQuery is available
window.onload = function() {
    // Check if jQuery is loaded
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded');
        return;
    }
    
    // Auto-scroll to bottom of messages
    if ($('#chatMessages').length) {
        $('#chatMessages')[0].scrollTop = $('#chatMessages')[0].scrollHeight;
    }
    
    // Send message on button click
    $('#sendMessageBtn').click(sendMessage);
    
    // Send message on Enter key
    $('#messageInput').keypress(function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    function sendMessage() {
        var message = $('#messageInput').val().trim();
        if(message === '') return;
        
        // Show loading state
        $('#sendMessageBtn').prop('disabled', true).text('发送中...');
        
        $.post('ajax.php', {
            action: 'send_message',
            siliaoid: <?php echo $chatId; ?>,
            neirong: message,
            fasongren: '<?php echo addslashes($_SESSION["username"]); ?>',
            cx: '<?php echo addslashes($_SESSION["cx"]); ?>'
        }, function(response) {
            // Re-enable button
            $('#sendMessageBtn').prop('disabled', false).text('发送');
            
            if(response && response.success) {
                // Clear input
                $('#messageInput').val('');
                
                // Reload messages to show the new one
                loadMessages();
            } else {
                alert('发送失败: ' + (response && response.message ? response.message : '未知错误'));
            }
        }, 'json')
        .fail(function(xhr, status, error) {
            // Re-enable button
            $('#sendMessageBtn').prop('disabled', false).text('发送');
            console.error('AJAX Error:', error);
            console.error('Response Text:', xhr.responseText);
            alert('发送失败: ' + error);
        });
    }
    
    function loadMessages() {
        $.get('ajax.php', {
            action: 'get_messages',
            siliaoid: <?php echo $chatId; ?>
        }, function(data) {
            if(data && data.success) {
                $('#chatMessages').html(data.html);
                $('#chatMessages')[0].scrollTop = $('#chatMessages')[0].scrollHeight;
            }
        }, 'json')
        .fail(function(xhr, status, error) {
            console.error('Load messages AJAX Error Details:');
            console.error('Status:', status);
            console.error('Error:', error);
            console.error('Response Text:', xhr.responseText);
            console.error('Status Code:', xhr.status);
        });
    }
    
    // Poll for new messages every 5 seconds
    setInterval(loadMessages, 5000);
};

// Function to format messages (defined on the page for simplicity)
function formatDate(dateString) {
    var date = new Date(dateString);
    return date.toLocaleString();
}
</script>

<?php include "footer.php" ?>
<?php include "foot.php" ?>