<?php
function getip() {
        if (isset($_SERVER)) {
                if (isset($_SERVER[HTTP_X_FORWARDED_FOR]) && strcasecmp($_SERVER[HTTP_X_FORWARDED_FOR], "unknown")) {//代理 
                        $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
                } elseif(isset($_SERVER[HTTP_CLIENT_IP]) && strcasecmp($_SERVER[HTTP_CLIENT_IP], "unknown")) {
                        $realip = $_SERVER[HTTP_CLIENT_IP];
                } elseif(isset($_SERVER[REMOTE_ADDR]) && strcasecmp($_SERVER[REMOTE_ADDR], "unknown")) {
                        $realip = $_SERVER[REMOTE_ADDR];
                } else {
                        $realip = 'unknown';
                }
        } else {
                if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
                        $realip = getenv("HTTP_X_FORWARDED_FOR");
                } elseif(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
                        $realip = getenv("HTTP_CLIENT_IP");
                } elseif(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
                        $realip = getenv("REMOTE_ADDR");
                } else {
                        $realip = 'unknown';
                }
        }
        return $realip;
}

?>