<?php 
session_start();
if ($_SESSION['info']['Id'] == null || $_SESSION['info']['Id'] == '') {
    die();
}

function ApiSendMessage($userId, $messageContent) {
    $messageContent = addslashes($messageContent);
    
    include_once(__DIR__ . '/database.php');

    $sql = "insert into lts_message(user_id, content) values('$userId', '$messageContent')";
    $arr = db_change($sql);
    var_dump($arr);
    if ($arr > 0){
        return true;
    } else {
        return false;
    }
}

?>