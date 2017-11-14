<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';
require './admin/dao/Order.class.php';
require './admin/dao/Price.class.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
}


require './admin/dao/Seo.class.php';
$Seo = new Seo($servername, $username, $password, $dbname);
$seo_by_id_result = $Seo->get_all();
$json_seo_by_id_result = json_decode($seo_by_id_result);


$order = new Order($servername, $username, $password, $dbname);

$order_result = $order->get_by_uid($_SESSION['userid']);

$json_order_result = json_decode($order_result);


$price = new Price($servername, $username, $password, $dbname);




function type_map($price, $type) {

  $price_result = $price->get_by_id($type);

  $json_price_result = json_decode($price_result);

  return $json_price_result->data[0]->title.':'.$json_price_result->data[0]->day_limit.'天时间限制，'.$json_price_result->data[0]->data_limit.'G流量限制';

}

function status_map($status, $id, $active_time) {

  switch ($status) {

    // 未支付,操作：删除
    case 0:
      return '未支付 <button class="btn btn-danger" onclick="del('.$id.')">删除</button>';
      break;

    // 未支付,操作：激活
    case 1:
      return '已支付 <button class="btn btn-success" id="activate" onclick="activate('.$id.')">激活</button>';
      break;

    // 未支付,操作：删除
    case 2:
      return '已经激活，激活时间：'.$active_time;
      break;
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
    <title>网站名称已替换VPN--订单中心 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>查看和管理你的所有订单</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="row my-pic-row">

              <?php

              if (sizeof($json_order_result->data) == 0) {
              ?>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                <div class="conversation thumbnail" >
                  <div class="order-logo">
                    <img src="img/buy.png" alt="">
                  </div>
                  <div class="order-line">还有有订单哇</div>
                  <div class="order-line"><a href="price.php" class="btn btn-success">购买</a></div>
                  <div class="clear"></div>
                </div>
              </div>

              <?php

              }

              for ($i =0; $i < sizeof($json_order_result->data); $i++) {

              ?>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                <div class="conversation thumbnail" >
                  <div class="order-logo">

                    <?php switch($json_order_result->data[$i]->type) {
                      case '1':
                        echo '<img src="img/day.png" class="radius wh150">';
                        break;
                      case '2':
                        echo '<img src="img/month.png" class="radius wh150">';
                        break;
                      case '3':
                        echo '<img src="img/halfyear.png" class="radius wh150">';
                        break;
                      case '4':
                        echo '<img src="img/year.png" class="radius wh150">';
                      break;
                    }
                    ?>


                  </div>
                  <div class="order-line"><?php echo type_map($price, $json_order_result->data[$i]->type); ?></div>
                  <div class="order-line"><?php echo status_map($json_order_result->data[$i]->status, $json_order_result->data[$i]->id, $json_order_result->data[$i]->active_time); ?></div>
                  <div class="clear"></div>
                </div>
              </div>

              <?php
              }
              ?>

            </div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

    </div>

</main>

<section class="jumbotron">

    <p class="lead">
        <h5>提示：订单套餐为累加机制，可以同时购买和激活不超过3个套餐，其期限和流量将会累加</h5>
    </p>

</section>

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
<script src="js/api.js"></script>

<script>
function del (id) {
  $.get(api.url + '/admin/data-api/Order.del.php',
    {
      id: id,
      uid: <?php echo $_SESSION['userid']; ?>
    },
    function(data){

      if (data.code == 0) {
        alert(data.msg);
        window.location.reload();
      } else {
        alert(data.msg);
      }

    }, "json");
}

function activate (id) {

  // 禁用按钮
  var activateBtn = document.getElementById('activate');

  activateBtn.disabled = 'true';
  activateBtn.innerHTML='正在激活...';

  console.log(activateBtn);


  $.get(api.url + '/admin/data-api/Order.activate.php',
    {
      id: id,
      uid: <?php echo $_SESSION['userid']; ?>
    },
    function(data){

      if (data.code == 0) {
        alert('激活订单成功！请前往用户中心查看 Shadowsocks 信息！');
        window.location.href = 'shadowsocks.php';
      } else {
        alert(data.msg);
      }

    }, "json");
}
</script>

</html>
