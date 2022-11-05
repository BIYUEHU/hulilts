<?php
if (!file_exists(__DIR__ . '/config.php')) {
    header('location: ./install');
    die();
}
include(__DIR__ . '/config.php');
include_once(__DIR__ . '/func.php');
