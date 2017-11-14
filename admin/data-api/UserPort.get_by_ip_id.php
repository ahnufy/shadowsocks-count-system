<?php

$ip=$_GET['ip_id'];

require '../config/db.config.php';
require '../dao/UserPort.class.php';

$UserPort = new UserPort($servername, $username, $password, $dbname);

$user_ports = $UserPort->get_by_ip_id($ip);

header("Access-Control-Allow-Origin:*");

echo $user_ports;
