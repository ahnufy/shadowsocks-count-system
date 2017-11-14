<?php
require '../lib/get_client_ip.php';
require '../config/db.config.php';
require '../dao/User.class.php';
require '../dao/Log.class.php';
require '../lib/random_str.php';
require '../lib/filter.php';

header("Access-Control-Allow-Origin:*");

$User = new User($servername, $username, $password, $dbname);
$log = new Log($servername, $username, $password, $dbname);

// $log->add(-1, 0, '尝试注册', get_client_ip());

$username=$_GET['username'];
$email=$_GET['email'];
$password=md5($_GET['password']);

$ss_password = base64_encode(random_str(8));

$code=$_GET['code'];
$recommender_email=$_GET['recommender_email'];

// 先检查邮箱是否存在，第一步便是邮箱和验证码的绑定
// 1.存在，更新验证码，适用于第一次没收到验证码的情形，或者第二次注册同一个邮箱，这里有个逻辑问题吧？
// 2.不存在，插入邮箱和验证码，适用于第一次发送验证码的清醒
// 3.注册的步骤可以看做是填充信息的步骤

$user_result = $User->get_by_email($email);

$json_user_result = json_decode($user_result);

if ($json_user_result -> code == '0') {

  $data =  $json_user_result -> data;

  $db_code = $data[0]->code;

  if ($code == $db_code) {
    // 完善用户注册的信息
    $reg_result = $User->reg($username, $email, $password,$ss_password, $recommender_email);
    echo $reg_result;
  } else {
    echo json_encode(array('code' => '2', 'msg' => '验证码不对！', 'data' => null));
    // $log->add(-2, 0, '验证码不对', get_client_ip());
  }

} else {
  echo json_encode(array('code' => '1', 'msg' => '用户注册时，数据库查询出现了异常！', 'data' => null));
}
