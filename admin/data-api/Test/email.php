<?php
require '../../lib/get_client_ip.php';
require '../../config/db.config.php';
require '../../dao/User.class.php';
require '../../dao/Log.class.php';
require '../../lib/random_str.php';
require '../../lib/filter.php';

$str = str_check($_GET['str']);
echo $str;

$num = num_check($_GET['num']);
echo $num;
