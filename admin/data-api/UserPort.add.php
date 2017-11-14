<?php

// 这个接口测试成功
// 添加两条或多条用户 ID 和 IP，端口的对应关系

// require '../config/debug.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../dao/UserPort.class.php';
require '../dao/Node.class.php';


$uid=$_GET['uid'];

// $group=$_GET['group']; // 用户的节点分组

$node_list = get($api.'/admin/data-api/Node.get_by_group.php?group=1');
$json_node_list = json_decode($node_list);


// 根据 uid 和 nodelist 来循环插入对应关系

// 插入之前需要先判断是否存在，这个非常重要

$UserPort = new UserPort($servername, $username, $password, $dbname);
$Node = new Node($servername, $username, $password, $dbname);

$user_ports = $UserPort->get_by_uid($uid);

if (sizeof(json_decode($user_ports)->data) ==0) {
  for ($i=0; $i< sizeof($json_node_list->data); $i++) {

    // 这个节点添加了一个用户后，就需要增加一下
    $Node->user_count_grow($json_node_list->data[$i]->id);

    $user_ports = $UserPort->add_node_port($uid, $json_node_list->data[$i]->id, $json_node_list->data[$i]->user_count_now + 2000);

    if (json_decode($user_ports)->code !=0){
      echo json_encode(array('code' => '1', 'msg' => '新建用户端口映射时出现异常！', 'data' => null));
      exit;
    }

  }

  header("Access-Control-Allow-Origin:*");
  echo json_encode(array('code' => '0', 'msg' => '新建用户端口成功！', 'data' => null));
} else {
  echo json_encode(array('code' => '2', 'msg' => '已经存在用户端口关系！', 'data' => null));
}
