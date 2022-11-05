<?php
/*发送消息*/
header('content-type:text/html;charset=utf-8');
session_start();
$userId = $_SESSION['info']['Id'];
    
$messageContent = trim($_POST['messageContent']);
if ($messageContent != null && $messageContent != "") {
    $messageContent = addslashes($messageContent);
    
    include_once('../core/database.php');

    $sql = "insert into lts_message(user_id, content) values('$userId', '$messageContent')";
    $arr = db_change($sql);
    if ($arr > 0) {
        include_once('../plugins/robot.php');
        MainRun($messageContent);

        header("location: ../chat.php");
    } else {
        echo '<script>alert("发送失败");window.location.href = "../chat.php";</script>';
    }
} else {
    echo '<script>alert("发送失败");window.location.href = "../chat.php";</script>';
}
?>