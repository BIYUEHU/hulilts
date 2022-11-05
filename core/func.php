<?php
include(__DIR__ . '/ini.php');

function db_change($sql) {
    global $dbIp, $dbUser, $dbPassword, $dbName;
    $DB = new mysqli($dbIp, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($DB,'utf8');
    $res = $DB -> query($sql);
    if (!$res === TRUE) {
        echo "DB Error: " . $DB -> error;
    }
    $DB -> close();
    return $res;
}


function db_select($sql) {
    global $dbIp, $dbUser, $dbPassword, $dbName;
    $DB = new mysqli($dbIp, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($DB,'utf8');
    $res = $DB -> query($sql);
    if (!$res === TRUE) {
        echo "DB Error: " . $DB -> error;
    }
    $arr = $res -> fetch_all(1);
    $DB -> close();
    return $arr;
}

//Admin判断
function isAdmin($loginName) {
    global $adminName1, $adminName2;
    $adminName = [$adminName1, $adminName2];
    $isAdmin = false;
    for ($a = 0; $a < count($adminName); $a++) {
        if ($loginName == $adminName[$a]) {
            $isAdmin = true;
        }
    }
    return $isAdmin;
}
?>