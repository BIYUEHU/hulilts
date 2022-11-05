<?php
/*账号登录*/

header("content-type:text/html;charset=utf-8");

//IPGet模块
include("../../../../../app/include/function.php");

$userName = $_POST['userName'];
$userPwd = $_POST['userPwd'];
if ($userName != null && $userName != '' && $userPwd != null && $userPwd != '') {
    include_once('../core/database.php');

    $sql = "select * from lts_user where userName = '$userName' and userPass = '$userPwd'";
    $arr = db_select($sql);
    
    if (count($arr) > 0){
        // 账号密码正确，登录成功
        header('location: ../chat.php');
        // 登录成功，用session记录一下登录的信息，来维持登录状态
        session_start();
        // 用session来记录登录人的这一条信息(用户名密码和头像)
        $_SESSION['info'] = $arr[0];
    } else {
        echo "账号或者密码错误,请<a href='../login.html'>重新登录</a>";
        echo "<script>alert('账号或密码错误,请重新登录');window.location.href = '../login.html';</script>";
    }
} else{
    echo "账号或者密码错误,请<a href='../login.html'>重新登录</a>";
    echo "<script>alert('账号和密码不能为空');window.location.href = '../login.html';</script>";
}
?>