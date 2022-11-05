<?php
if ($_GET['par'] == 'bg') {
    $background = $_FILES['background'];
    if ($background) {
        $name = $background['name'];
        $type = array_pop(explode('.',$name));
        $size = $background['size'];
        if (($type == 'jpg' || $type == 'png' || $type == 'jpeg') && $size <= 10 * 1024 * 1024) {
            $tmp_path = $background['tmp_name'];
            $newName = iconv('utf-8', 'gbk', $oldName);
            $new_path = '../images/background.png';
            $res = move_uploaded_file($tmp_path,$new_path);
            
        }
    }
    
    header('location: ./?p=5');
    exit();
}


$title = trim($_POST['title']);
if ($title != null) {
    $guild = trim($_POST['guild']);
    $admin1 = trim($_POST['admin1']);
    $admin2 = trim($_POST['admin2']);
    
    $back = "<?php
    \$title = '$title';
    \$guild = '$guild';
    \$adminName1 = '$admin1';
    \$adminName2 = '$admin2';
    ?>";
    file_put_contents('../core/config.php', $back);
    header('location: ./?p=4');
    exit();
}


$dbIp = trim($_POST['dbIp']);
$dbName = trim($_POST['dbName']);
$dbUser = trim($_POST['dbUser']);
$dbPassword = trim($_POST['dbPassword']);
if ($dbIp != null && $dbName != null && $dbUser != null && $dbPassword != null) {
    $back = "<?php
    \$dbIp = '$dbIp';
    \$dbName = '$dbName';
    \$dbUser = '$dbUser';
    \$dbPassword = '$dbPassword';
    ?>";
    file_put_contents('../core/ini.php', $back);
    
    
    include_once('../core/ini.php');
    include_once('../core/func.php');
    $DB = new mysqli($dbIp, $dbUser, $dbPassword, $dbName);

    if ($DB -> connect_error) {
        echo '<script>alert("错误:' . $DB -> connect_error . ',请检查数据库配置否正确");window.location.href = "./?p=2";</script>';
        die();
    }
    
    /*初始化数据库*/
    
    
    $sql = "CREATE TABLE `lts_user` (
      `Id` int(11) NOT NULL AUTO_INCREMENT,
      `userName` varchar(10) NOT NULL,
      `userPass` varchar(50) NOT NULL,
      `userIcon` varchar(255) NOT NULL,
      `userIp` varchar(255) NOT NULL DEFAULT '',
      `userLocation` varchar(255) NOT NULL DEFAULT '',
      `reg_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`Id`, `userName`)
    ) CHARSET=utf8;";
    db_change($sql);
    
    $sql = "CREATE TABLE `lts_message` (
      `Id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL DEFAULT '0',
      `content` varchar(255) NOT NULL DEFAULT '',
      `isDelete` varchar(20) NOT NULL DEFAULT 'no',
      `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`Id`)
    ) CHARSET=utf8;";
    db_change($sql);
    
    echo '<script>alert("初始化数据库完成！");window.location.href = "./?p=3";</script>';
    exit();
}

echo '<script>alert("请正确填写必要内容");window.history.go(-1);</script>'

?>