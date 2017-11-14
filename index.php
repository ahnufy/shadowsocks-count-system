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
    <title>网站名称已替换VPN官网--最好的免费VPN和付费VPN | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>世界这么大，翻出去看看，Google、Facebook、YouTube...</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="row my-pic-row">

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/earth.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        特选高速宽带
                    </div>
                    <div class="gray-text text-center">
                        选遍全球知名 IDC 服务商，只为了找到更快的那家。宽带线路，硬件资源全都是顶级配置，只为了你更快速的访问。
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/up.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        内外网智能分流
                    </div>
                    <div class="gray-text text-center">
                        PAC自动代理是Shadowsocks的最重要特性，根据配置对已屏蔽网站和未屏蔽网站自动分流，不影响内网访问速度。
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/double.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        两条高速线路
                    </div>
                    <div class="gray-text text-center">
                      线路多没有用，快才有用。日本靠近中国，硅谷是互联网中心。美日双线，在家或公司、电信或联通，总有一个更快。
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/ok.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        安全隐私必备
                    </div>
                    <div class="gray-text text-center">
                      广受赞誉，安全可靠的 Shadowsocks，通过建立安全通道连接，能有效加密网络通信，确保网络数据的完整和安全。
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/system.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        设备支持广泛
                    </div>
                    <div class="gray-text text-center">
                        Windows、Mac、iOS、Android 或者是路由器设备，统统支持，让你随时随地，自由自在的使用各种设备来访问。
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                    <div class="thumbnail">
                      <img src="img/heart.png" class="radius wh150">
                    </div>

                    <div class="my-text text-center big-text">
                        完美用户体验
                    </div>
                    <div class="gray-text text-center">
                      我们提供二维码扫描来简化配置，告别繁琐的操作；我们的售后服务，无论你选择哪档套餐，都一视同仁无差别对待。
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

    </div>

</main>

<section class="jumbotron">

    <p class="lead">
        <h5>郑重声明：网站名称已替换产品仅提供网络优化技术服务，使用必须遵循本国及服务器所在地区相关法律法规。</h5>
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
