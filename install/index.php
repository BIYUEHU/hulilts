<?php 
$page = intval($_GET['p']);
if (file_exists('../locked') && $page != 5) {
    header('location: ../index.php');
}

switch ($page) {
    case 2 :
            $pageHtml = '<form method="post" action="./install.php">
            <h2>二.数据库信息</h2>
    
            <table>
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">*数据库地址</label>
                        <input type="text" name="dbIp" class="form-control" value="localhost">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">*数据库名字</label>
                        <input type="text" name="dbName" class="form-control" value="chatdb">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">*数据库用户名</label>
                        <input type="text" name="dbUser" class="form-control" placeholder="用户名">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2">*数据库密码</label>
                        <input type="password" name="dbPassword" class="form-control" placeholder="密码">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <br>
                        <button type="submit" class="btn login">下一步</button>
                    </td>
                </tr>
            </table>
        </form>';
    break;
    case 3:
            $pageHtml = '<form method="post" action="./install.php">
            <h2>三.网站设置</h2>
    
            <table>
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">*网站标题</label>
                        <input type="text" name="title" class="form-control" value="HULILTS-聊天室">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">网站公告</label>
                        <input type="text" name="guild" class="form-control" value="富强民主文明和谐自由平等公正法治友善">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2" for="exampleInputEmail1">①号管理员名字</label>
                        <input type="text" name="admin1" class="form-control">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <label class="color2">②号管理员名字</label>
                        <input type="text" name="admin2" class="form-control">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <br>
                        <label style="color:fuchsia">对应名字的聊天室账号拥有聊天室内管理员权限，允许指定两个</label>
                    </td>
                </tr>
    
    
                <tr>
                    <td>
                        <br>
                        <button type="submit" class="btn login">下一步</button>
                    </td>
                </tr>
            </table>
        </form>';
    break;
    case 4:
            $pageHtml = '<form method="post" action="./install.php?par=bg" enctype="multipart/form-data">
            <h2>四.背景设置</h2>
    
            <table>
                <tr>
                    <td>
                        <input name="background" type="file">
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <br>
                        <label style="color:fuchsia">聊天室界面背景设置，非必要；支持jpg、jpeg、png格式，<=10MB</label>
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <br>
                        <button type="submit" class="btn login">下一步</button>
                    </td>
                </tr>
            </table>
        </form>';
    break;
    case 5:
            $pageHtml = '<form>
            <h2>五.安装完毕</h2>
    
            <table>
                <tr>
                    <td>
                        <br>
                        <label style="color:fuchsia">安装完成，建议手动删除根目录下的<i>install/</i>文件夹</label>
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <br>
                        <button class="btn login"><a href="../index.php">跳转</a></button>
                    </td>
                </tr>
            </table>
        </form>';
    break;
    default : 
        $pageHtml = '<form>
        <table>
            <tr>
                <td>
                    <strong>
                        <h1 style="color:hotpink">HULILTS-聊天室</h1>
                    </strong>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
    
    
            <tr>
                <td>
                    <h2>一.开始</h2>
                </td>
            </tr>
    
            <tr>
                <td>
                    <h4><label>本程序由BIYUEHU🦊制作，开源地址-><strong><a>Github</a></strong></label><br></h4>
                    <h4><label style="color:crimson">允许自行更改源码、可供学习，该程序即为他人源码二次魔改，但严禁发布！！！</label></h4>
                    <h3><label><a style="color:aqua" target="_blank" href="http://imlolicon.tk">糊狸的博客</a> <a style="color:blueviolet"
                                 target="_blank" href="https://space.bilibili.com/293767574">Bilibili@糊狸</a></label></h3>
                </td>
            </tr>
    
            <tr>
                <td>
                    <br>
                    <span id="timer"><button type="submit" class="btn">安装(7)</button></span>
                </td>
            </tr>
        </table>
    </form>
    
        <script>
            let maxTime = 7;
    
            let timer = setInterval(() => {
                maxTime -= 1;
                document.getElementById("timer").innerHTML = `<button type="submit" class="btn">安装(${maxTime})</button>`;
            }, 1000)
    
            setTimeout(() => {
                document.getElementById("timer").innerHTML = `<a style="color:#fff" href="./?p=2" class="btn login">安装</a>`;
                clearTimeout(timer);
            }, (maxTime) * 1000)
        </script>';
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安装 HULILTS-聊天室</title>
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index2.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php 
        echo $pageHtml;
    ?>
</body>

</html>