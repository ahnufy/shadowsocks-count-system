<?php

// 本方法，访问每个节点的 API，获取流量，然后写进数据库种的对应的 IP 上

require '../config/api.config.php';
// require '../config/debug.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/Node.class.php';
require '../config/db.config.php';
require '../dao/Log.class.php';

// 敏感服务的监控
session_start();

$uid = 0; // 0默认为系统
if(isset($_SESSION['userid'])){
    $uid = $_SESSION['userid'];
}

$node = new Node($servername, $username, $password, $dbname);
$group_result = $node->get_active_node_group();
$json_group_result= json_decode($group_result);

$log = new Log($servername, $username, $password, $dbname);

$log->add(100, $uid, '同步数据', '开始，来源 IP：'.get_client_ip());


// 第一步，根据节点组，拿到该组下面的服务器

$nodes = $node->get_by_group($json_group_result->data[0]->node_group);
$nodes_json= json_decode($nodes);

// 第二步，遍历组下面的 IP
for ($i =0; $i < sizeof($nodes_json->data); $i++) {

  // 第三步，访问节点的 IP，获得这个节点的流量统计
  $url = 'http://'.$nodes_json ->data[$i]->ip.'/网站名称已替换/admin/ss-api/data.php';
  $node_port_datas = file_get_contents($url);

  echo $node_port_datas;

  $json_node_port_datas = json_decode($node_port_datas);

  // 第四步，得到input 和 outpust，遍根据IP的端口，将流量写进数据库
  foreach($json_node_port_datas as $key => $val){
    $result = get($api.'/admin/data-api/UserPort.update_by_ip_port.php?ip='.$nodes_json ->data[$i]->ip.'&port='.$key.'&input='.$val->input.'&output='.$val->output);
  }

}


$log->add(100, $uid, '同步数据', '结束，来源 IP：'.get_client_ip());
