<?php

// 需要接口测试成功

// 本接口功能：判断这个用户的流量是否超过了 limit 的流量
// 以及日期是否超过？
// 两者有一个，则表示，应该停止

// 添加权限校验，否则，会有风险

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/UserData.class.php';
require '../dao/UserPort.class.php';
require '../dao/Log.class.php';


$uid=$_GET['uid'];

$log = new Log($servername, $username, $password, $dbname);

// $log->add(0, $uid, '套餐状态查询', get_client_ip());

$UserData = new UserData($servername, $username, $password, $dbname);
$user_data_result = $UserData->get_by_uid($uid);
$json_user_data_result = json_decode($user_data_result);


$UserPort = new UserPort($servername, $username, $password, $dbname);
$user_port_result = $UserPort->get_by_uid($uid);
$json_user_port_result = json_decode($user_port_result);

// 通过流量记录，获取用户已经使用的总流量
// 循环累加已经使用的总流量
$data_used = 0;
for ($i = 0; $i < sizeof($json_user_port_result->data); $i++) {
  $in_out = (int) $json_user_port_result->data[$i]->in_data + (int) $json_user_port_result->data[$i]->out_data;
  $data_used += $in_out;
}

// 注意时区问题
date_default_timezone_set('Asia/Shanghai');

// 可能没有值，直接反悔 false
if (sizeof($json_user_data_result->data) ==0) {
  // $log->add(-3, $uid, '套餐超出状况', '这个用户未建立记录');
  echo json_encode(array('code' => '1', 'msg' => '这个用户未建立记录', 'data' => false));
} else {

  // 日期是否大于今天？大于从日期累加，不大于，直接新增

  $date_now = date("y-m-d h:i:s");

  $date_db = $json_user_data_result->data[0]->expires_time;
  $data_limit_db = $json_user_data_result->data[0]->data_limit;

  // 时间未过期，检测流量
  if(strtotime($date_now)<strtotime($date_db)){
    if ($data_used > (int)$data_limit_db) {
      // $log->add(-2, $uid, '套餐超出状况', '这个用户流量超限');
      echo json_encode(array('code' => '2', 'msg' => '这个用户流量超限', 'data' => false));
    } else {
      // $log->add(-1, $uid, '套餐超出状况', '这个用户状态正常');
      echo json_encode(array('code' => '0', 'msg' => '这个用户状态正常', 'data' => true));
    }
  }

  // 时间已经过期
  else {
    // $log->add(-2, $uid, '套餐超出状况', '这个用户时间过期');
    echo json_encode(array('code' => '3', 'msg' => '这个用户时间过期', 'data' => false));
  }

}
