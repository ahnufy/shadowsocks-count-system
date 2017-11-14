<?php

// require '../config/debug.config.php';
require '../config/db.config.php';
require '../dao/User.class.php';
require '../dao/Log.class.php';
require '../lib/get_client_ip.php';

$log = new Log($servername, $username, $password, $dbname);

$User = new User($servername, $username, $password, $dbname);

header("Access-Control-Allow-Origin:*");

$to = $_GET['to'];

$subject = "=?UTF-8?B?".base64_encode('网站名称已替换 | 网站名称已替换---邮箱验证码')."?=";

$code = rand(100000,999999);

$content = $code;

$headers = 'From: postmaster <postmaster@网站名称已替换.org>' . "\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=uft-8' . "\r\n";
$headers .="Content-Transfer-Encoding: 8bit";

// 是否存在该邮箱判断
$by_email_result = $User->get_by_email($to);
$json_by_email_result = json_decode($by_email_result);

// 新邮箱，直接绑定邮箱和验证码
if (sizeof($json_by_email_result->data) == 0) {

  $result = $User->add_email_code($to, $code);
  $send = mail($to, $subject, $content, $headers);

  if ($send) {
    echo $result;
  } else {
    echo json_encode(array('code' => '1', 'msg' => '验证码发送失败！邮件服务器发送错误！', 'data' => null));
  }

}
// 邮箱已经存在，更新邮箱的验证码
else {

  // 判断邮箱上次的更新时间，必须大于1分钟
  $now_time = strtotime (date("y-m-d H:i:s"));
  $db_time = strtotime ($json_by_email_result->data[0]->update_time);
  $diff = ceil(($now_time-$db_time) / 60);

  if ($diff > 1) {

    $result = $User->update_email_code($to, $code);
    $send = mail($to, $subject, $content, $headers);

    if ($send) {
      echo $result;
    } else {
      echo json_encode(array('code' => '1', 'msg' => '验证码发送失败！邮件服务器发送错误！', 'data' => null));
    }

  } else {
    echo json_encode(array('code' => '2', 'msg' => '发送验证码间隔必须大于1分钟', 'data' => null));
  }

}
