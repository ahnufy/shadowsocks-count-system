<?php

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/Order.class.php';
require '../dao/Price.class.php';
require '../dao/Log.class.php';


$log = new Log($servername, $username, $password, $dbname);

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
}


$id = $_GET['id']; // 这里的 id 是订单号
$uid = $_GET['uid']; // 需要校验是否合法，只能删除子级的订单


$order = new Order($servername, $username, $password, $dbname);

// 先检查订单状态，如果是未付款，允许删除，如果是以付款，则隐藏，不允许删除
$order_info_result = $order->get_by_id($id);


$json_order_info_result = json_decode($order_info_result);

if ($json_order_info_result->data[0]->status == 0) {
  $order_result = $order->del_by_id($id);
} else {
  echo json_encode(array('code' => '1', 'msg' => '删除订单失败', 'data' => null));
}


$json_order_result = json_decode($order_result);

if ($json_order_result->code == 0) {
  // $log->add(0, $uid, '删除订单成功', get_client_ip().'，订单 ID:'.$id);
  echo json_encode(array('code' => '0', 'msg' => '删除订单成功', 'data' => null));
} else {
  // $log->add(-2, $uid,'删除订单失败', get_client_ip().'，订单 ID:'.$id);
  echo json_encode(array('code' => '402', 'msg' => $json_order_result->msg, 'data' => null));
}

?>
