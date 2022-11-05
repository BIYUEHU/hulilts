<?php
/*账号登出*/

//session
session_start();
unset($_SESSION['info']);

header('location: ../login.html');
?>