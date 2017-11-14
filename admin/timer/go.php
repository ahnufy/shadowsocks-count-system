<?php

require '../config/api.config.php';
require '../lib/http.php';

$sync_result = get($api.'/admin/action/sync_data.php');
echo $sync_result.'<hr>';
sleep(1);
$reload_result = get($api.'/admin/action/reload.php');
echo $reload_result;


?>
