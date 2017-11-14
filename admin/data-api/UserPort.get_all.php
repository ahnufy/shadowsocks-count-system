<?php

require '../config/db.config.php';
require '../dao/UserPort.class.php';

$UserPort = new UserPort($servername, $username, $password, $dbname);

$all_user_ports = $UserPort->get_all();

header("Access-Control-Allow-Origin:*");

echo $all_user_ports;
