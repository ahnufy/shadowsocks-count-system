<?php

// require '../config/debug.config.php';
require '../config/app.config.php';
require '../config/api.config.php';
require '../config/db.config.php';
require '../lib/http.php';
require '../dao/UserData.class.php';

$order_id = $_GET['order_id'];
$price = $_GET['price'];
$body = $_GET['body'];

$appid = $corpid;
$body = $body;
$mch_id = $mch_id;
$nonce_str = 'lq930102';
$notify_url = $api.'/admin/pay-callback/index.php';
$out_trade_no = $order_id;
$spbill_create_ip = '192.168.1.2';
$total_fee = $price;
$trade_type='NATIVE';


$stringA = 'appid='.$appid.'&body='.$body.'&mch_id='.$mch_id.'&nonce_str='.$nonce_str.'&notify_url='.$notify_url.'&out_trade_no='.$out_trade_no.'&spbill_create_ip='.$spbill_create_ip.'&total_fee='.$total_fee.'&trade_type='.$trade_type;
$stringTemp = $stringA.'&key='.$app_key;
$md5 = md5($stringTemp);
$sign = strtoupper($md5);

$xml = '<xml>';
$xml .= '<appid>'.$appid.'</appid>';
$xml .= '<mch_id>'.$mch_id.'</mch_id>';
$xml .= '<nonce_str>'.$nonce_str.'</nonce_str>';
$xml .= '<sign>'.$sign.'</sign>';
$xml .= '<body>'.$body.'</body>';
$xml .= '<out_trade_no>'.$out_trade_no.'</out_trade_no>';
$xml .= '<total_fee>'.$total_fee.'</total_fee>';
$xml .= '<spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>';
$xml .= '<notify_url>'.$notify_url.'</notify_url>';
$xml .= '<trade_type>'.$trade_type.'</trade_type>';
$xml .= '</xml>';

$result = post('https://api.mch.weixin.qq.com/pay/unifiedorder', $xml);

echo $result;