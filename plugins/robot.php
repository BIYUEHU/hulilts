<?php 
/* 导入SDK模块 */
require(__DIR__ . '../../core/sdk.php');

/* 设置机器人账号ID */
define('robotId', null);

/* 主要部分 */
function MainRun($message) {
    if ($message == '菜单' || $message == '功能' || $message == 'cd') {
        $back = "菜单: pixiv图 糊理一言 谜语 农历 查字[字] 网易云音乐搜索[名字] 网易云音乐下载[音乐ID] 网站状态[URL] 网站测速[URL] AI聊天:#[内容]";
    };
    if ($message == 'pixiv图') {
        $back = '图片来咯~害羞羞~' . file_get_contents('http://imlolicon.tk/api/seimg/?r18=true&format=text');
    };
    if ($message == '糊理一言') {
        $back = file_get_contents('http://imlolicon.tk/api/hitokoto/?format=text');
    };
    if ($message == '谜语') {
        $back = file_get_contents('http://82.157.165.201/api/riddle');
        $back = json_decode($back) -> data;
        $back = "谜语:{$back -> topic} 谜底:{$back -> answer} 类型:{$back -> type} 提示:${$back -> ps}";
    };
    if ($message == '农历') {
        $back = file_get_contents('http://82.157.165.201/api/lunar');
    };
    if (mb_substr($message, 0, 1) == '#') {
        $back = file_get_contents('http://82.157.165.201/api/chat?msg=' . mb_substr($message, 1));
        $back = json_decode($back) -> data;
    };
    if (mb_substr($message, 0, 2) == '查字') {
        $back = file_get_contents('http://82.157.165.201/api/diction?msg=' . mb_substr($message, 2));
        $back = json_decode($back) -> data;
        $back = "字:{$back -> word} 音节:{$back -> yinjie} 部首:{$back -> bushou} 部首笔画:{$back -> bushou_bihua} 字笔画:{$back -> bihua} 笔画顺序:{$back -> xiefa}";
    };
    if (mb_substr($message, 0, 7) == '网易云音乐搜索') {
        $back = file_get_contents('http://82.157.165.201/api/nemusic?b=1&msg=' . mb_substr($message, 7));
        $back = json_decode($back) -> data;
        $back = "音乐ID :{$back -> id} 名字:{$back -> name} 歌手:{$back -> singer}";
    };
    if (mb_substr($message, 0, 7) == '网易云音乐下载') {
        $back = file_get_contents('http://82.157.165.201/api/nemusicdl?id=' . mb_substr($message, 7));
        $back = json_decode($back) -> data;
        $back = "{$back[0] -> url}";
    };
    if (mb_substr($message, 0, 4) == '网站状态') {
        $back = file_get_contents('http://82.157.165.201/api/webtool?op=1&url=' . mb_substr($message, 4));
    };
    if (mb_substr($message, 0, 4) == '网站测速') {
        $back = file_get_contents('http://82.157.165.201/api/webtool?op=3&url=' . mb_substr($message, 4));
    };
    
    if ($back) {
        $back = $back . '   ByBIYUEHU';
        ApiSendMessage(robotId, $back);
    }
};

?>