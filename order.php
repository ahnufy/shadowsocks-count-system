<?php

// 根据不同的 type，来结算和充值

// require './admin/config/debug.config.php';
require './admin/config/api.config.php';
require './admin/config/db.config.php';
require './admin/lib/http.php';

require './admin/dao/Order.class.php';

require './admin/dao/Price.class.php';

require './admin/dao/Log.class.php';
$log = new Log($servername, $username, $password, $dbname);

session_start();

require './admin/dao/Seo.class.php';
$Seo = new Seo($servername, $username, $password, $dbname);
$seo_by_id_result = $Seo->get_all();
$json_seo_by_id_result = json_decode($seo_by_id_result);

// 在写入订单数据库前，先检查 uid，为什么 uid 会为0呢？
if(!isset($_SESSION['userid']) || $_SESSION['userid'] == '0'){
    header("Location:havenotlogin.php");
} else {
  $uid = $_SESSION['userid'];
}

$type = $_GET['type'];

$price = new Price($servername, $username, $password, $dbname);

$price_result = $price->get_by_id($type);

$json_price_result = json_decode($price_result);

$price = $json_price_result->data[0]->price * $json_price_result->data[0]->discount / 100;

$body = $json_price_result->data[0]->title;



// 写入订单数据库

$order = new Order($servername, $username, $password, $dbname);
$result = $order-> add($uid, $type, $price);

$json_result = json_decode($result);

// 得到订单 ID：
$order_id = $json_result -> data -> id;

$unifed_order = get($api.'/admin/data-api/UnifedOrder.new.php?order_id='.$order_id.'&price='.$price.'&body='.$body);

// echo $unifed_order;

// 解析$unifed_order
$xml = new DOMDocument();
$xml->loadXML($unifed_order);

$root = $xml->documentElement;

$prepay_id; // 预付订单号
$code_url; // 二维码付款 URL

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
    if ($item->nodeName == "prepay_id") {
        $prepay_id = $item->nodeValue;
    }

    if ($item->nodeName == "code_url") {
        $code_url = $item->nodeValue;
    }

}

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width,height=device-height,target-densitydpi=device-dpi,inital-scale=1.0"/>
    <meta name="keywords"
          content="<?php echo $json_seo_by_id_result->data[0]->keywords; ?>"/>
    <meta name="description"
          content="<?php echo $json_seo_by_id_result->data[0]->description; ?>"/>
    <meta name="author" content="网站名称已替换&trade;&nbsp;网站名称已替换">
    <meta name="robots" content="all">
    <meta name="revisit-after" content="1 days">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>网站名称已替换VPN--订单支付 | 更快速的VPN, 更稳定的ShadowSocks</title>

    <link rel="apple-touch-icon-precomposed" href="apple.png">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <nav class="navbar navbar-inverse site-navbar">

      <div class="container">

          <div class="navbar-header">

              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                      aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="index.php">网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span></a>

          </div>

          <div id="navbar" class="collapse navbar-collapse">

              <ul class="nav navbar-nav">

                  <li>
                      <a href="values.php">愿景和信念</a>
                  </li>


                  <li>
                      <a href="price.php">套餐价格</a>
                  </li>

                  <li>
                      <a href="free.php">免费使用</a>
                  </li>

                  <li>
                      <a href="help.php">使用帮助</a>
                  </li>

                  <li>
                    <?php
                    if (!isset($_SESSION['userid'])) {
                      echo '<a href="login.html">登录|注册</a>';
                    } else {
                      echo '<a href="user.php">个人中心</a>';
                    }
                    ?>
                  </li>

              </ul>
          </div>

      </div>
  </nav>

<header class="jumbotron">

    <h1>
        <span class="text-hide">
            <span>
                <img class="logo" src="img/bymax.png">
            </span>
        </span>
    </h1>

    <p class="lead">
        <h4>请稍候，马上就好</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            <div class="row my-pic-row">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                    <div class="thumbnail h220">

                      <?php

                      if ($return_code == 'SUCCESS' && $result_code == 'SUCCESS') {
                        // $log->add(-1, $uid, '订单二维码成功', $code_url);
                        echo '<img class="qr-code" src="/admin/data-api/QRCode.get.php?text='.urlencode($code_url).'">';
                      } else {
                        echo '二维码获取失败，请重试';
                        // $log->add(-2, 0, '订单二维码失败', $uid);
                      }

                      ?>

                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">

                  <div class="thumbnail h220">

                    <div class="pay-txt-wraper">
                      <div>电脑请使用手机微信扫一扫支付</div>
                      <div>手机使用微信从本地扫一扫支付</div>
                      <div>微信内长按图片识别二维码支付</div>
                    </div>

                    <div class="pay-btn-wraper">
                      <a href="orderlist.php" class="btn btn-success">支付完成</a>
                      <a href="help.php" class="btn btn-danger">遇到问题</a>
                    </div>

                  </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>

    </div>

</main>


<footer class="footer">
    <div class="container">
      <p>© 网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span>，更快速，更稳定，更安全<span class="loveyou"></span></p>
      <p>ICP 备案号 京-A-404-Not Found</p>
    </div>
</footer>

</body>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slid.min.js"></script>

</html>
