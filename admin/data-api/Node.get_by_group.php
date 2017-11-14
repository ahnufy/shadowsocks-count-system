<?php

require '../lib/filter.php';

$group=$_GET['group'];

require '../config/db.config.php';
require '../dao/Node.class.php';

$node = new Node($servername, $username, $password, $dbname);

$node_list = $node->get_by_group($group);

header("Access-Control-Allow-Origin:*");

echo $node_list;
