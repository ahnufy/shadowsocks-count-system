<?php

// 添加两条或多条用户 ID 和 IP，端口的对应关系

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../dao/UserData.class.php';


$uid=$_GET['uid'];

// 插入之前需要先判断是否存在，这个非常重要

$UserData = new UserData($servername, $username, $password, $dbname);

$user_data_result = $UserData->get_by_uid($uid);

echo $user_data_result;
