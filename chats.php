<?php require_once 'initialize.php'; 

// Check if user is logged in
if(empty($_SESSION["username"]) || $_SESSION["username"] == "") {
    header("Location: login.php");
    exit;
}

// Get all chats for the current user
$chats = M("siliao")->where("
    shouxinren='" . $_SESSION["username"] . "' 
    OR faxinren='" . $_SESSION["username"] . "'"
)->order("id desc")->select();
?>

<?php include "header.php" ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的聊天</title>
    <link href="qtstyle/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 20px;
        }
        
        .chat-list-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .chat-list-header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }
        
        .chat-item {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            text-decoration: none;
            color: inherit;
            transition: background-color 0.2s;
        }
        
        .chat-item:hover {
            background-color: #f8f9fa;
        }
        
        .chat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        
        .chat-info {
            flex: 1;
        }
        
        .chat-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .chat-preview {
            font-size: 14px;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .chat-time {
            font-size: 12px;
            color: #999;
        }
        
        .no-chats {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="chat-list-container">
    <div class="chat-list-header">
        我的聊天
    </div>
    
    <?php if(count($chats) > 0): ?>
        <?php foreach($chats as $chat): ?>
            <?php 
            // Determine the other participant in the chat
            $otherUser = $chat['shouxinren'] === $_SESSION["username"] ? $chat['faxinren'] : $chat['shouxinren'];
            
            // Get the other participant's info (could be user or landlord)
            $userInfo = M("yonghu")->where("yonghuming", $otherUser)->find();
            $landlordInfo = M("fangdong")->where("zhanghao", $otherUser)->find();
            
            // Determine which info to use
            $avatar = '';
            $name = $otherUser;
            $cx = '';

            if($userInfo) {
                $avatar = $userInfo['touxiang'];
                $name = $userInfo['xingming'];
                $cx = '用户';
            } elseif($landlordInfo) {
                $avatar = $landlordInfo['touxiang'];
                $name = $landlordInfo['xingming'];
                $cx = '房东';
            }
            
            // Get the latest message in the chat
            $latestMessage = M("jilu")->where("siliaoid", $chat['id'])->order("id desc")->find();
            ?>
            
            <a href="siliaoadd.php?chatid=<?php echo $chat['id']; ?>&shouxinren=<?php echo $otherUser; ?>" class="chat-item">
                <img src="<?php echo $avatar ? $avatar : 'images/default.gif'; ?>" alt="头像" class="chat-avatar">
                <div class="chat-info">
                    <div class="chat-name"><?php echo $name; ?> <span style="font-size: 12px; color: #999;">(<?php echo $cx; ?>)</span></div>
                    <div class="chat-preview">
                        <?php if($latestMessage): ?>
                            <?php echo htmlspecialchars($latestMessage['neirong']); ?>
                        <?php else: ?>
                            开始聊天...
                        <?php endif; ?>
                    </div>
                </div>
                <div class="chat-time">
                    <?php if($latestMessage): ?>
                        <?php echo date('m-d H:i', strtotime($latestMessage['addtime'])); ?>
                    <?php else: ?>
                        <?php echo date('m-d H:i', strtotime($chat['addtime'])); ?>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-chats">
            <p>暂无聊天记录</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>