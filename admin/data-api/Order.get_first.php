<?php

require '../config/db.config.php';
require '../dao/Order.class.php';

// 消费状态查询
// 根据 id，查找是否有他的订单，有的话状态是否等于2，等于2的话，按时间排序

$uid = $_GET['uid'];


$order = new Order($servername, $username, $password, $dbname);

$all_orders = $order->get_first_by_uid($uid);

$json_all_orders = json_decode($all_orders);
// var_dump($all_orders);

if (sizeof($json_all_orders -> data) > 0) {
  echo json_encode(array('code' => '0', 'msg' => '已消费', 'data' => $json_all_orders -> data[0]));
} else {
  echo json_encode(array('code' => '1', 'msg' => '未消费', 'data' => null));
}

