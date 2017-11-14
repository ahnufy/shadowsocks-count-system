<?php
// 免费服务器的启动服务

require '../../config/db.config.php';
require '../../dao/Log.class.php';

$log = new Log($servername, $username, '930102@my', $dbname);

// 这两个属于敏感服务，需要检验域名是否为 free 节点下
$host = '';

if ($_SERVER['HTTP_HOST']!= $host) {
  echo "权限不允许";
} else {
  passthru("sudo nohup ssserver -c /etc/shadowsocks.json -d start",$sttrslt);
  echo "<hr/>启动:",$sttrslt."<hr/>";

  $log->add(-2, '免费服务器', '启动', '早晨6点');
}
