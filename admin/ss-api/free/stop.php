<?php
// 免费服务器的停止服务

require '../../config/db.config.php';
require '../../dao/Log.class.php';
$log = new Log($servername, $username, '930102@my', $dbname);

// 这两个属于敏感服务，需要检验域名是否为 free 节点下
$host = '45.76.99.89';

if ($_SERVER['HTTP_HOST']!= $host) {
  echo "权限不允许";
} else {
  passthru("sudo ssserver -c /etc/shadowsocks.json -d stop",$stprslt);
  echo "<hr/>关闭:",$stprslt;
  $log->add(-2, '免费服务器', '关闭', '早晨8点');
}
