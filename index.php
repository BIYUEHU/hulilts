<?php
header("content-type:text/html;charset=utf-8");
include_once('./core/database.php');

// 开启session
session_start();
$loginName = $_SESSION['info']['userName'];

if(!isset($_SESSION['info'])){
    $loginName = '未登录';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title;?>
    </title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>

<body>
    <div class="title">
        <h1 class="f_l" style="color:lightblue"><?php echo $title;?></h1>
        <h1 class="f_l"><a href="./view.php">用户查看</a></h1>
        <h1 class="f_l"><a href onclick="guide()">公告</a></h1>
        <h1 class="f_l"><a target="_blank" href="https://github.com/biyuehu">糊狸</a></h1>
        <div class="user f_r">
            <?php
            if($loginName != '未登录') {
                if (isAdmin($loginName)) {
                    $loginName = '<font color="#FF0000">' . $loginName . '</font>';
                }
            
                echo '<h2>' . $loginName . '</h2>
                <img class="img" src="' . $_SESSION['info']['userIcon'] . '" alt="" />
                <a href="./method/doLogout.php">登出</a>';
            } else {
                echo '<h2>' . $loginName . '</h2>
                <a href="./login.html">登入</a>';
            }
            ?>
        </div>

    </div>
    <div class="container">
        <div style="text-align:center" class="message">
            <br>
            <br>
            <br>
            <br>
            <h1><a class="login" href="./chat.php">开始聊天⚪</a></h1>
            <h1><a class="login" href="./register.html">注册账号➕</a></h1>
            <h2>该网页使用<a style="color:orange" href=""><i>HULILTS聊天室系统</i></a><br>
            <strong><a style="color:lightblue" href="http://imlolicon.tk">Bybiyuehu🦊</a></strong></h2>
            <h1><a style="color:pink" href="http://imlolicon.tk/sponsor">打赏作者👉</a></h1>
        </div>
    </div>
</body>

</html>
<script>
    function guide() {
        alert('<?php echo $guild;?>')
    }
</script>