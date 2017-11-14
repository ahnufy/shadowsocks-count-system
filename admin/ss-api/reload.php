<?php

// 写入 json 文件后,直接重启shadowsocks服务就 OK
passthru("sudo ssserver -c /etc/shadowsocks.json -d stop",$stprslt); //先关掉,再启动,带nohup
echo "<hr/>关闭:",$stprslt;

passthru("sudo nohup ssserver -c /etc/shadowsocks.json -d start",$sttrslt);
echo "<hr/>启动:",$sttrslt."<hr/>";
