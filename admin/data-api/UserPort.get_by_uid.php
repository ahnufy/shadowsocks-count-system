<?php

$id=$_GET['id'];

require '../config/db.config.php';
require '../dao/UserPort.class.php';

$UserPort = new UserPort($servername, $username, $password, $dbname);

$user_ports = $UserPort->get_by_uid($id);

header("Access-Control-Allow-Origin:*");

echo $user_ports;
