<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';

session_start();

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
    <title>网站名称已替换VPN代理、VPN软件--免费使用 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>免费使用，参与进来，还能挣钱</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="row my-pic-row">

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/card.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        推荐免费用
                    </div>
                    <div class="gray-text text-center">
                        每推荐一位新用户，一旦对方初次消费，你就能得到同样的套餐。
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/wallet.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        推荐能挣钱
                    </div>
                    <div class="gray-text text-center">
                        推荐的年付用户达到10人，便可以申请返现，直接赚取你的收入。
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 item">

                  <a href="recommendhistory.php">
                    <div class="thumbnail">
                      <img src="img/history.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                      我的推荐记录
                    </div>
                    <div class="gray-text text-center">
                        点击查看被你推荐的所有用户，以及与之相对应的收益记录明细。
                    </div>
                    </a>
                </div>

            </div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

    </div>

</main>

<section class="jumbotron">

    <p class="lead">
        <h5>“朝阳计划”针对向往外部世界的山区青少年，提供免费的网络代理服务。请与我们邮件联系：<a class="white-under" href="mailto:postmaster@网站名称已替换.org">postmaster@网站名称已替换.org</a>。</h5>
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
