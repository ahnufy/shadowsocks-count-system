<?php

 // $user_ports = $_POST['user_ports'];
 $user_ports =  file_get_contents("php://input");
 $user_ports_arr = json_decode($user_ports);

 // 注意要给777权限
 $config = fopen("/etc/shadowsocks.json", "w") or die("Unable to open file!");

 $head = "{\n    \"server\": \"::\", \n    \"local_address\": \"127.0.0.1\",\n    \"local_port\": 1080,\n    \"timeout\": 600,\n    \"method\": \"aes-256-cfb\",\n    \"fast_open\": false,\n    \"port_password\": {";

 $json_txt = '';

 foreach ($user_ports_arr as $key => $value) {
   $json_txt = $json_txt."\n        \"".$key."\": \"". $value."\",";
 }

 $json_txt = substr($json_txt, 0, strlen($json_txt)-1);

 $foot = "\n    }\n}";

 fwrite($config, $head . $json_txt . $foot);

 fclose($config);
