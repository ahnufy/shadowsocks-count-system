<?php

$ip=$_GET['ip'];
$port=$_GET['port'];
$input=$_GET['input'];
$output=$_GET['output'];

require '../config/db.config.php';
require '../dao/UserPort.class.php';
require '../dao/Node.class.php';

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';

$UserPort = new UserPort($servername, $username, $password, $dbname);
$Node = new Node($servername, $username, $password, $dbname);


// 这里需要多加一层，根据 ip 来寻找ID
$node_result = $Node->get_by_ip($ip);
$json_node_result = json_decode($node_result);


$result = $UserPort->update_input_output($json_node_result->data[0]->id, $port, $input, $output);

header("Access-Control-Allow-Origin:*");

echo $result;
