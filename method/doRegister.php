<?php
/*账号注册*/
header("content-type:text/html;charset=utf-8");
include_once('../core/database.php');
    
$userName = trim($_POST['userName']);
    
$temp = 0;
if ($userName != null && $userName != "") {
    $sql = "select * from lts_user";
    // 执行sql
    $arr = db_select($sql);
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]['userName'] == $userName) {    
            $temp = -2;//失败
            break;
        }
    }
        
        
    $allowType = array('jpg', 'png', 'jpeg');
    $allowSize = 2048 * 1024;
        
        
    $userIcon = $_FILES['userIcon'];
    $name = $userIcon['name'];
    $type = array_pop(explode('.',$name));
    $size = $userIcon['size'];
        
    if ($type != $allowType[0] && $type != $allowType[1] && $type != $allowType[2]) {
        $temp = -4;
    }
        
    if ($size > $allowSize) {
        $temp = -3;
    }
        
        
    $password = $_POST['userPwd'];
    $oldName = $userIcon['name'];
    $tmp_path = $userIcon['tmp_name'];//原本的图片路径
    $newName = $userName . rand(1, 2333) . '.' . $type;
    $new_path = '../images/icon/' . $newName;//新路径
    $res = move_uploaded_file($tmp_path,$new_path);//转移到新的文件夹
        
    if ($temp === 0) {
        //IPGet模块
        require("../plugins/ipget.php");
        $ip = getip();
        $returnData = json_decode(file_get_contents('https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query=' . $ip . '&co=&resource_id=6006&oe=utf8'));
        $location = ($returnData -> data)[0] -> location;
                
        $sql = "insert into lts_user(userName, userPass, userIcon, userIp, userLocation) values('$userName','$password','./images/icon/{$newName}', '$ip', '$location')";
        $rows = db_change($sql);
        echo $rows;
        if ($rows > 0) {
            echo "注册成功,<a href='../login.html'>点击登录</a> ";
            echo "<script>alert('注册成功,请重新登录');window.location.href = '../login.html';</script>";
        } else {
            echo "注册失败,<a href='../register.html'>重新注册</a> ";
            echo "<script>alert('注册失败 请重新注册');window.location.href = '../register.html';</script>";
            unlink($new_path);
        }
    } else if ($temp == -2) {
        echo "<script>alert('注册失败:用户名已被使用,请重新注册');window.location.href = '../register.html';</script>";
        unlink($new_path);
    } else if ($temp == -4) {
        echo "<script>alert('注册失败:头像文件只支持png或jpg或jpeg,请重新注册');window.location.href = '../register.html';</script>";
        unlink($new_path);
    } else if ($temp == -3) {
        echo "<script>alert('注册失败:头像文件大小必须<=2MB,请重新注册');window.location.href = '../register.html';</script>";
        unlink($new_path);
    } else {
        echo "<script>alert('注册失败,请重新注册');window.location.href = '../register.html';</script>";
        unlink($new_path);
    }
}
?>