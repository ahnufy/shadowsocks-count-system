<?php

// 清除某个端口的流量统计数据

$port = $_GET['port'];

echo '端口号'.$port;

$cmd = "sudo iptables -xvnL --line-numbers|grep ".$port."|awk '{print $1}'|sed -n '1p'";

echo '<hr>命令'.$cmd;

// 得到规则号,这一步有问题,少了 sudo 啊
$rule_number = shell_exec($cmd);

echo '<hr>规则号'.$rule_number;

$cmd2 = "sudo iptables -Z OUTPUT ".$rule_number;
echo '<hr>命令'.$cmd2;
// 清空这个规则好下面的流量统计
system($cmd2);

$cmd3 = "sudo iptables -Z INPUT ".$rule_number;
echo '<hr>命令'.$cmd3;
// 清空这个规则好下面的流量统计
system($cmd3);

?>
