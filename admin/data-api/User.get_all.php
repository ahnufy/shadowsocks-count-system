<?php

require '../config/db.config.php';
require '../dao/User.class.php';

$User = new User($servername, $username, $password, $dbname);

$all_users = $User->get_all();

header("Access-Control-Allow-Origin:*");

echo $all_users;
