# HULILTS

**推荐PHP版本:**7.1+

简易聊天室，非WS、不支持热更新，简单且又低效了属于是

支持长期存储数据，因为存储在Mysql里，默认仅允许已注册且登录用户查看/发送聊天记录，默认仅允许管理员撤回自己与他人聊天记录，默认仅允许管理员可查看用户信息统计(IP、归属地、密码等)

默认最多只支持设置两名管理员

## LTSROBOT

本项目为他人项目上二次魔改(已经魔改的面目全非了)，扩展了许多功能，并且支持自定义聊天机器人

```php
<?php 
/* 导入SDK模块 */
require(__DIR__ . '../../core/sdk.php');

/* 设置机器人账号ID */
define('robotId', 5);

/* 主要部分 */
function MainRun($message) {
    if ($message == '菜单' || $message == '功能' || $message == 'cd') {
        $back = "菜单: pixiv图 糊理一言 谜语 农历 查字[字] 网易云音乐搜索[名字] 网易云音乐下载[音乐ID] 网站状态[URL] 网站测速[URL] AI聊天:#[内容]";
    };
    if ($message == 'pixiv图') {
        $back = '图片来咯~害羞羞~' . file_get_contents('http://imlolicon.tk/api/seimg/?r18=true&format=text');
    };
    //...
    if (mb_substr($message, 0, 1) == '#') {
        $back = file_get_contents('http://82.157.165.201/api/chat?msg=' . mb_substr($message, 1));
        $back = json_decode($back) -> data;
    };
    //...
    
    $back = $back . '   ByBIYUEHU';
    ApiSendMessage(robotId, $back);
};

?>

```

`/plugins/robot.php`自带实例

结构简单，可自行开发机器人功能

## ~~SMTP~~
已砍掉，~~但我觉得还是有必要腾个位置在这~~



