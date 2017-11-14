<?php

 $id=$_GET['id'];

require '../config/db.config.php';
require '../dao/User.class.php';

$User = new User($servername, $username, $password, $dbname);

$a_user = $User->get_by_id($id);

header("Access-Control-Allow-Origin:*");

echo $a_user;
