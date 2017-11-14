<?php

 $host = $_SERVER['HTTP_HOST'];

 if ($host == 'localhost') {
   $password = ""; // 本地环境
 } else {
   $password = "";
   $root = 'root';
 }


$servername = "localhost";
$username = "root";
$dbname = ""; // 数据库名

// 注意时区问题，所有用到数据库的地方，都设置下时区
date_default_timezone_set('Asia/Shanghai');
