<?php

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/Order.class.php';
require '../dao/Price.class.php';
require '../dao/Log.class.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
} else {
    $uid = $_SESSION['userid'];
}

$log = new Log($servername, $username, $password, $dbname);

$id = $_GET['id']; // 这里的 id 是订单号
$uid = $_GET['uid']; // 这里的 id 是订单号

// 根据 id 从 orders 里面获取 type
$order = new Order($servername, $username, $password, $dbname);
$order_result = $order->get_by_id($id);

$json_order_result = json_decode($order_result);

$type = $json_order_result->data[0]->type;

// 根据 type 从数据库来获取对应的套餐的日期和流量期限
$price = new Price($servername, $username, $password, $dbname);
$price_result = $price->get_by_id($type);

$json_price_result = json_decode($price_result);


$add_day = $json_price_result->data[0]->day_limit;
$add_data = $json_price_result->data[0]->data_limit * 1024 * 1024 * 1024;

// 购买成功后，需要为用户开通帐号，也就是建立 uid 和 ip 端口的关联，端口只会有一个，IP 会有2个或者多个
// 并且，根据用户 ID，来写入流量控制表

$user_port_result = get($api.'/admin/data-api/UserPort.add.php?uid='.$uid);
$json_user_port_result = json_decode($user_port_result);

// 等于1为异常，等于0和2都为正常
if ($json_user_port_result -> code == 1) {
  // $log->add(-2, $uid, '尝试激活订单失败', get_client_ip());
  echo $user_port_result;
} else {

  $user_data_result = get($api.'/admin/data-api/UserData.add.php?uid='.$uid.'&add_day='.$add_day.'&add_data='.$add_data);

  $json_user_data_result = json_decode($user_data_result);

  // 注意，这里只有1为有问题的状态，0和2都没有问题，2表示端口关系已经存在
  if ($json_user_data_result -> code == 0 || $json_user_data_result -> code == 2) {

    // 还有更新数据库里面的订单状态，以便知道已经支付成功并且生效了
    $order = new Order($servername, $username, $password, $dbname);

    $order->update_status($id, 2); // 0新创建， 1已经支付，2已经使用

    // 需要重启机器
    get($api.'/admin/action/reload.php');


    echo json_encode(array('code' => '0', 'msg' => '激活订单成功！', 'data' => null));

    // $log->add(0, $uid, '尝试激活订单成功', get_client_ip());

  } else {
    echo $json_user_data_result;
  }

}

?>
