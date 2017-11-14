<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/Price.class.php';

session_start();

$price = new Price($servername, $username, $password, $dbname);

$price_result = $price->get_all();

$json_price_result = json_decode($price_result);

require './admin/dao/Seo.class.php';
$Seo = new Seo($servername, $username, $password, $dbname);
$seo_by_id_result = $Seo->get_all();
$json_seo_by_id_result = json_decode($seo_by_id_result);

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
    <title>网站名称已替换VPN购买、VPN账号--套餐价格 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
      <h4>网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span>，快速、稳定、安全、信誉。</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">




            <div class="row my-pic-row">


              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                <div class="conversation thumbnail" >
                  <div class="order-logo">
                    <img src="img/flat long shadow icons-gift.png" alt="">
                  </div>
                  <div class="order-line">
                    <strong>开学季大惊喜：</strong>
                    全线优惠！并且现在购买任意套餐，享受1-365天、且1-1200G流量的随机大礼包赠送！
                    <br>
                    购买、激活后请在套餐统计里查收吧！
                    <br>
                    赶快推荐给朋友吧！
                  </div>
                  <div class="clear"></div>
                </div>

              </div>


              <?php
                // var_dump($json_price_result);
                for ($i = 0; $i < sizeof($json_price_result->data); $i++) {
              ?>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">

                      <?php switch($json_price_result->data[$i]->day_limit) {
                        case '1':
                          echo '<img src="img/day.png" class="radius wh150">';
                          break;
                        case '30':
                          echo '<img src="img/month.png" class="radius wh150">';
                          break;
                        case '180':
                          echo '<img src="img/halfyear.png" class="radius wh150">';
                          break;
                        case '365':
                          echo '<img src="img/year.png" class="radius wh150">';
                        break;
                      }
                      ?>

                    </div>

                    <div class="my-text text-center">
                        <?php echo $json_price_result->data[$i]->title;?>
                    </div>
                    <div class="gray-text text-center">
                        <?php echo $json_price_result->data[$i]->day_limit;?>天时间限制
                    </div>
                    <div class="gray-text text-center">
                        <?php echo $json_price_result->data[$i]->data_limit;?>G流量限制
                    </div>
		    <div class="gray-text text-center discount">
                        无客户端数量限制
                    </div>
                    <div class="gray-text text-center">
                        <?php echo $json_price_result->data[$i]->introduction;?>
                    </div>
                    <div class="gray-text text-center">
                        原价：￥<?php echo $json_price_result->data[$i]->price / 100;?>元
                    </div>

                    <div class="gray-text text-center discount">
                        <?php
                        if ($json_price_result->data[$i]->discount==100) {
                          echo '暂无折扣活动，敬请期待';
                        } else {
                          echo ($json_price_result->data[$i]->discount / 10).'折，折后：￥'.($json_price_result->data[$i]->price *  $json_price_result->data[$i]->discount / 100 / 100).'元';
                        }
                        ?>
                    </div>

                    <div class="gray-text text-center">
                        <a class="btn btn-success buy" href="order.php?type=<?php echo $json_price_result->data[$i]->id;?>">购买</a>
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
        <h5>我们也提供面向企业的专线服务，价格优惠，无任何限制，一企一机。请与我们联系：<a class="white-under" href="mailto:postmaster@网站名称已替换.org">postmaster@网站名称已替换.org</a>。</h5>
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

</html>
