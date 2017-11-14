<?php

 $host = $_SERVER['HTTP_HOST'];

 if ($host == 'localhost') {
   $api = 'http://localhost/'; // 方便调适
 } else {
   $api = '';// api主机地址配置
 }
