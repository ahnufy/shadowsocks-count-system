<?php

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/UserData.class.php';
require '../dao/UserPort.class.php';
require '../dao/Node.class.php';
require '../dao/Log.class.php';

$log = new Log($servername, $username, $password, $dbname);
$node = new Node($servername, $username, $password, $dbname);


$uid=$_GET['uid'];
$add_day=$_GET['add_day']; // 需要添加的参数
$add_data=$_GET['add_data']; // 需要添加的流量

// 流量需要： * 1024 * 1024 * 1024
// 这里添加一个逻辑：随机赠送流量，1-20天，1-50G。

// 年套餐
if ($add_day > 180) {
  $free_add_day = rand(60,90);
  $free_add_data = rand(200,300) * 1024 * 1024 * 1024;
}
// 半年套餐
else if ($add_day > 30) {
  $free_add_day = rand(30,60);
  $free_add_data = rand(100,150) * 1024 * 1024 * 1024;
}
// 月套餐
else if ($add_day > 1) {
  $free_add_day = rand(10,15);
  $free_add_data = rand(30,50) * 1024 * 1024 * 1024;
}
// 日套餐
else {
  $free_add_day = rand(1,5);
  $free_add_data = rand(1,10) * 1024 * 1024 * 1024;
}
$add_day +=  $free_add_day;
$add_data += $free_add_data;
// 免费随机增加逻辑结束

$UserData = new UserData($servername, $username, $password, $dbname);
$user_data_result = $UserData->get_by_uid($uid);
$json_user_data_result = json_decode($user_data_result);

$UserPort = new UserPort($servername, $username, $password, $dbname);

// 这里的逻辑，有新的变动：
// 1.不存在的话，表示是新用户：直接添加即可
// 2.存在的话，检查时间和流量限制
// 2.1时间或者流量超过限制的话，清空这个端口的流量，时间从现在开始，流量限制新加
// 2.2时间并且流量没有超过限制的话，时间和流量均累加

if (sizeof($json_user_data_result->data) ==0) {

  // 没有，直接新增
  $expires_time = date('Y-m-d H:i:s',strtotime('+'.$add_day.' day'));
  $data_limit = 0 + (int)$add_data;

  $user_add_data_result = $UserData->add_control($uid, $expires_time, $data_limit);
  echo $user_add_data_result;

}

else {

  // 检查数据流量是否超限，没超限，累加，超限，清0累加现在
  $ok_result = get($api.'/admin/data-api/UserData.ok.php?uid='.$uid);

  // echo $ok_result;
  $json_ok_result = json_decode($ok_result);


  // 状态都正常，表示时间和流量均正常，则直接累加
  if ($json_ok_result->code == 0) {

    $date_db = $json_user_data_result->data[0]->expires_time;
    $data_db = $json_user_data_result->data[0]->data_limit;

    $expires_time = date('Y-m-d H:i:s', strtotime($date_db) + $add_day * 24 * 60 * 60);
    $data_limit = (int)$data_db + (int)$add_data;
  }
  // 只要不正常，那么：时间变成现在加上天数，流量限制变成这个值，远端机器统计清0，本地机器也清0
  else {

    $expires_time = date('Y-m-d H:i:s',strtotime('+'.$add_day.' day'));
    $data_limit = 0 + (int)$add_data;


    // 本地机器流量统计清0
    $user_port_result = $UserPort->get_by_uid($uid);
    $json_user_port_result = json_decode($user_port_result);

    for ($j = 0; $j< sizeof($json_user_port_result->data); $j++) {


      $log->add(-2, 0, '流量清0', $json_user_port_result->data[$j]->ip_id.':'.$json_user_port_result->data[$j]->port);

      // 本地流量记录循环清0
      $UserPort->update_input_output($json_user_port_result->data[$j]->ip_id, $json_user_port_result->data[$j]->port, 0, 0);

      // 远程 ip 清零，通过 ip_id拿到 ip 地址然后发送远程请求
      $node_list = $node->get_by_id($json_user_port_result->data[$j]->ip_id);
      $json_node_list = json_decode($node_list);

      // 只会有1个
      $clear_result = get('http://'.$json_node_list->data[0]->ip.'/网站名称已替换/admin/ss-api/clear.php?port='.$json_user_port_result->data[$j]->port);

    }

  }

  // 流量限制更新
  $user_update_data_result = $UserData->update_by_uid($uid, $expires_time, $data_limit);

  echo $user_update_data_result;

}
