<?php

require '../config/db.config.php';
require '../config/api.config.php';
require '../dao/Log.class.php';
require '../dao/Order.class.php';
require '../lib/http.php';


// 测试,把返回的信息直接写入数据库

$xml_str = file_get_contents("php://input");

$order = new Order($servername, $username, $password, $dbname);
$log = new Log($servername, $username, $password, $dbname);

$log->add(0, 0, '微信支付回调成功', $xml_str);



$xml = new DOMDocument();
$xml->loadXML($xml_str);

$root = $xml->documentElement;

$out_trade_no; // 我们的订单号
$total_fee; // 微信收到的费用
$transaction_id; // 微信的流水帐号

$return_code;
$result_code;

foreach ($root->childNodes AS $item) {

    // 状态
    if ($item->nodeName == "return_code") {
        $return_code = $item->nodeValue;
    }
    if ($item->nodeName == "result_code") {
        $result_code = $item->nodeValue;
    }

    // 通用数据的获取
    if ($item->nodeName == "out_trade_no") {
        $out_trade_no = $item->nodeValue;
    }

    if ($item->nodeName == "total_fee") {
        $total_fee = $item->nodeValue;
    }

    if ($item->nodeName == "transaction_id") {
        $transaction_id = $item->nodeValue;
    }

}

// 然后，根据支付完成 id，更新数据库里面的订单状态，状态 OK 了，同时为用户开通流量和日期

// 首先，看是否成功

if ($return_code == 'SUCCESS' && $result_code == 'SUCCESS') {

  // 这里要进行判断，如果现在的状态为0，那么就更新为1，这个回掉会多次触发注意防止覆盖
  $order_result = $order->get_by_id($out_trade_no);

  $json_order_result = json_decode($order_result);

  $status = $json_order_result->data[0]->status;

  if ($status == '0') {

    $order->update($out_trade_no, 1, $total_fee); // 0新创建， 1已经支付，2已经使用

    // 这里让用户手动激活比较好

  }

}
else {
  $log->add(-2, 0, '微信支付回调失败', $xml_str);
}

?>
