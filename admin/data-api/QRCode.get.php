<?php

// 注意，需要开启 GD 库

require '../lib/phpqrcode.php';
// require '../config/debug.config.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:accesserror.php");
}

$text = $_GET['text'];

$text = urldecode($text);

QRcode::png($text, false, 'L', 10);

?>
