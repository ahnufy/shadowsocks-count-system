<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
}

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
  <title>网站名称已替换VPN--用户中心 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
                      echo '<a href="logout.php">退出登录</a>';
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
        <h4>你的个人信息和 Shadowsocks 信息</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="row my-pic-row">


                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item">
                  <a href="usersetting.php">
                    <div class="thumbnail">
                      <img src="img/person.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center">
                        用户设置
                    </div>
                    <div class="gray-text text-center">
                        管理和查看用户名，邮箱，密码
                    </div>
                  </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item">
                  <a href="shadowsocks.php">
                    <div class="thumbnail">
                      <img src="img/setting.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center">
                        Shadowsocks账户
                    </div>
                    <div class="gray-text text-center">
                        管理和查看Shadowsocks账户
                    </div>
                  </a>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item">
                  <a href="datadetail.php">
                    <div class="thumbnail">
                      <img src="img/trend.png" class="radius wh150">
                    </div>
                    <div class="my-text text-center">
                        套餐统计
                    </div>
                    <div class="gray-text text-center">
                        管理和查看你的流量数据
                    </div>
                  </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item">
                  <a href="orderlist.php">
                    <div class="thumbnail">
                      <img src="img/bag.png" class="radius wh150">
                    </div>
                    <div class="my-text text-center">
                        订单中心
                    </div>
                    <div class="gray-text text-center">
                        管理和查看您的所有订单
                    </div>
                  </a>
                </div>

            </div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

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
