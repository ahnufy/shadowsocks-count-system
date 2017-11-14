<?php

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../dao/Order.class.php';

// 插入之前需要先判断是否存在，这个非常重要

$id = $_GET['id'];

$UserData = new Order($servername, $username, $password, $dbname);

$user_data_result = $UserData->get_by_id($id);

echo $user_data_result;
