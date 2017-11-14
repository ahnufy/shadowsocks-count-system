<?php
session_start();

//注销登录
unset($_SESSION['userid']);

echo $_SESSION['userid'];
header("Location:index.php");
exit;

?>
