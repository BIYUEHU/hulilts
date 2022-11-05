<?php
/*信息撤回:软删除*/
include_once('../core/database.php');

$Id = $_GET['msgId'];
$sql = "update lts_message set isDelete = 'yes' where Id = $Id";

$arr =  db_change($sql);
if($arr > 0){
    header('location: ../chat.php');
}else {
    echo '<script>alert("撤销失败");window.location.href = "../";</script>';
}
?>