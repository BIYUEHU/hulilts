<?php
header("content-type:text/html;charset=utf-8");
include_once('./core/database.php');

session_start();
if(!isset($_SESSION['info'])){
    header('location: ./login.html');
    return false;
}

?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>用户查看-<?php echo $title;?></title>
  <link href="https://cdn.staticfile.net/bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/index3.css" rel="stylesheet" type="text/css">
</head>

<body class='bg-success'>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="">用户查看</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li>
            <a href="./">首页</a>
          </li>
<!--          <li>
            <a href="./register.html">新增</a>
          </li>-->
        </ul>
<!--        <form class="navbar-form navbar-left" style="margin:0" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">搜索</button>
        </form>-->
        <ul class="nav navbar-nav">
          <li>
            <a href="">用户:<?php echo $_SESSION['info']['userName'];?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">

    <table class="table table-bordered  table-striped">
      <thead>
        <tr>
          <th width='15%'>序号</th>
          <th width='15%'>名字</th>
          <th width='15%'>密码</th>
          <th width='15%'>IP</th>
          <th width='15%'>地址</th>
          <th width='55%'>头像</th>
        </tr>
      </thead>
        <tbody>
            <?php
                header("contentg-type:text/html;charset=utf-8");
                $sql = "select * from lts_user";
                $arr = db_select($sql);
                
                if (isAdmin($_SESSION['info']['userName'])) {
                    for($i = 0; $i < count($arr); $i++) {
                        echo '<tr><td>' . $arr[$i]['Id'] . '</td><td>' . $arr[$i]['userName'] . '</td><td>'. $arr[$i]['userPass'] . '</td><td>'. $arr[$i]['userIp'] . '</td><td>'. $arr[$i]['userLocation'] . '</td><td><a href="' . $arr[$i]['userIcon'] . '"><img src="' . $arr[$i]['userIcon'] . '" alt=""/></a></td></tr>';
                    }
                } else {
                    echo "<script>alert('拒绝访问！');window.history.back(-1);</script>";
                }
                ?>
        </tbody>
    </table>
  </div>
</body>

</html>