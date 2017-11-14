<?php

require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../lib/get_client_ip.php';
require '../dao/User.class.php';
require '../dao/Node.class.php';
require '../dao/UserPort.class.php';
require '../dao/Log.class.php';

// 敏感服务的监控
session_start();

$uid = 0; // 0默认为系统
if(isset($_SESSION['userid'])){
    $uid = $_SESSION['userid'];
}


$log = new Log($servername, $username, $password, $dbname);

$log->add(100, $uid, '刷新系统', '开始，来源 IP：'.get_client_ip());

// 第一步，拿到用户 id 和 shadowsocks密码，这里只有单一对应关系，放心获取

$user = new User($servername, $username, $password, $dbname);
$users_result = $user->get_all();
$users_object = json_decode($users_result);


$node = new Node($servername, $username, $password, $dbname);
$group_result = $node->get_active_node_group();
$json_group_result= json_decode($group_result);

// 第二步，拿到用户的uid 和端口,为什么要按照 IP 来拿呢？因为多个节点下面的话，要按照 IP 对应的机器去批量更新服务器配置文件
// 并且，如果是两台机器的话，都是一一对应的话还好，如果是多台机器，那么并不是每个 ip是另一个 ip的副本
// 比如，我们按照双节点的思路，每个用户默认有两个节点：日本和美国，这时候有一个用户额外购买了一个节点，那么这台机器上的用户数和其他两台就并不一致
// 要明确区分和搞清楚两者：用户，和节点的关系

// 目前默认只有一台机器，多台的话，循环呗，只关心每一台机器也就是每一个 IP 的端口和 port
// 1token 2post ip@2

$node_result = $node->get_by_group($json_group_result->data[0]->node_group);
$json_node_list= json_decode($node_result);

for ($z = 0; $z < sizeof($json_node_list->data); $z++) {


  $user_port = new UserPort($servername, $username, $password, $dbname);
  $user_port_result = $user_port->get_by_ip_id($json_node_list->data[$z]->id);
  $user_ports_object= json_decode($user_port_result);

  // // 第三步，根据端口和密码，交由IP 对应的服务器重新写入配置，组织好端口和密码
  //
  $user_port_array = array();

  for ($i = 0; $i < sizeof($users_object->data); $i++) {

    for ($j = 0; $j < sizeof($user_ports_object->data); $j++) {

      if ($users_object->data[$i]->id === $user_ports_object->data[$j]->uid) {
        $base64_txt = base64_decode($users_object->data[$i]->ss_password);

        // 这里需要加一步骤：这个用户的状态是否 OK 呢？是的才写入，不是就不写入
        $result = get($api.'/admin/data-api/UserData.ok.php?uid='.$users_object->data[$i]->id);

        $json_result = json_decode($result);

        if ($json_result->code == 0) {
          $user_port_array[$user_ports_object->data[$j]->port] = $base64_txt;
        }

      }

    }

  }

  // // 写入IP对应的机器的配置，多台机器的话，通过 IP 访问，讲 IP 塞到这里即可
  $rewrite_result = post('http://'.$json_node_list->data[$z]->ip.'/网站名称已替换/admin/ss-api/rewrite.php', json_encode($user_port_array));

  // // 第四步，重启这个 ip 对应的服务器，多台机器的话，通过 IP 访问，讲 IP 塞到这里即可
  $reload_result = get('http://'.$json_node_list->data[$z]->ip.'/网站名称已替换/admin/ss-api/reload.php');

  echo $reload_result;
}

$log->add(100, $uid, '刷新系统', '结束，来源 IP：'.get_client_ip());
