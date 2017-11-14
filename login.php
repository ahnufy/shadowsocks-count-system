<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';

session_start();

//登录
if(!isset($_POST['submit'])){
      header("Location:accesserror.php");
}


$post_email = $_POST['email'];
$post_password = MD5($_POST['password']);

$User = new User($servername, $username, $password, $dbname);
$by_email_result = $User->get_by_email($post_email);
$json_by_email_result = json_decode($by_email_result);

if (sizeof($json_by_email_result->data) > 0) {

  if ($json_by_email_result->data[0]->password == $post_password) {
    $_SESSION['userid'] = $json_by_email_result->data[0]->id;
    header("Location:user.php");
  } else {
    header("Location:passworderror.php");
  }

} else {
  header("Location:havenotreg.php");
}
?>
