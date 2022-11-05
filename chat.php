<?php
header("content-type:text/html;charset=utf-8");
include_once('./core/database.php');

// 开启session
session_start();

if(!isset($_SESSION['info'])){
    // 打回登录页面
    header('location: ./login.html');
    return false;
}

$loginName = $_SESSION['info']['userName'];
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

<body onload="window.scrollTo(0,document.body.scrollHeight);">
    <div class="title">
        <h1 class="f_l" style="color:lightblue"><?php echo $title;?></h1>
        <h1 class="f_l"><a href="./view.php">用户查看</a></h1>
        <h1 class="f_l"><a href onclick="guide()">公告</a></h1>
        <h1 class="f_l"><a target="_blank" href="https://github.com/biyuehu">糊狸</a></h1>
        <div class="user f_r">
            <h2>
                <?php 
                if (isAdmin($loginName)) {
                    $loginName_ = '<font color="#FF0000">' . $loginName . '</font>';
                } else {
                    $loginName_ = $loginName;
                }
                echo $loginName_;
                ?>
            </h2>
            <img class="img" src="<?php echo $_SESSION['info']['userIcon']?>" alt="" />
            <a href="./method/doLogout.php">登出</a>
        </div>

    </div>
    <div class="container">
        <div class="message">
            <!--遍历数据库并输出消息-->
            <?php
            $sql = "select m.Id,m.user_id,m.content,m.time,u.userName,u.userIcon,u.userLocation  from  lts_message m inner join  lts_user u on m.user_id = u.Id where isDelete = 'no' order by m.Id asc";
            $arr = db_select($sql);
            
            for($i = 0; $i < count($arr); $i++):
                $temp = $arr[$i];
                if(isAdmin($temp['userName'])) {
                    $userName = '<font color="#FF0000">' . $temp['userName'] . '</font>';
                } else {
                    $userName = $temp['userName'] . ' <i>' . explode('省', $temp['userLocation'])[0] . '</i>';
                }
                if (isAdmin($loginName)) {
                    $callback = ' <a class="btn btn-default" href="./method/doCallback.php?msgId=' . $temp['Id'] . '">撤回</a>';
                }
                if($temp['userName'] != $loginName):
            ?>
                <div class="left clearfix">
                    <h3 class="userName">
                        <?php echo $userName;?>
                    </h3>
                    <a href="#" class='f_l'>
                        <img src="<?php echo $temp['userIcon']?>" alt="">
                    </a>
                    <p class='f_l'>
                        <?php echo Htmlentities($temp['content']) . ' <i>' . $temp['time'] . '</i>' . $callback;?>
                    </p>
                </div>
            <?php 
            
            else:
            ?>
                <div class="right clearfix">
                    <a href="#" class='f_r'>
                        <img src="<?php echo $_SESSION['info']['userIcon']?>" alt="">
                    </a>
                    <p class='f_r'>
                        <?php echo Htmlentities($temp['content']) . ' <i>' . $temp['time'] . '</i>' . $callback;?>
                    </p>
                </div>
            <?php endif;?>
            <?php endfor;?>
        </div>
        <form action="./method/doSendMessage.php" method="POST">
            <div class="control">
                <input type="text" name="messageContent" class='inputBox f_l'>
                <input type="submit" class='sendButton f_r' value='发 送'>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    function guide() {
        alert('<?php echo $guild;?>')
    }
</script>