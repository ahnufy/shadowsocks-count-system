<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';
require './admin/dao/UserPort.class.php';
require './admin/dao/UserData.class.php';
require './admin/lib/data_formater.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
}

require './admin/dao/Seo.class.php';
$Seo = new Seo($servername, $username, $password, $dbname);
$seo_by_id_result = $Seo->get_all();
$json_seo_by_id_result = json_decode($seo_by_id_result);



$User = new User($servername, $username, $password, $dbname);
$by_id_result = $User->get_by_id($_SESSION['userid']);
$json_by_id_result = json_decode($by_id_result);

$user = $json_by_id_result->data[0];

$UserPort = new UserPort($servername, $username, $password, $dbname);
$by_uid_result = $UserPort->get_by_uid($_SESSION['userid']);
$json_by_uid_result = json_decode($by_uid_result);

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
    <title>网站名称已替换VPN--Shadowsock账户 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>查看您的Shadowsocks信息</h4>
    </p>

</header>

<main class="container">

    <div class="row my-pic-row">

      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>

      <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">


        <?php

        if (sizeof($json_by_uid_result->data) > 0) {
          $user_port = $json_by_uid_result->data[0];
          $port = $user_port->port;


         ?>

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

           <div class="conversation thumbnail" >
             <div class="order-logo">
               <img src="img/buy.png" alt="">
             </div>
             <div class="order-line">你已购买网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span>正式版，拥有双线服务器以及最好的用户体验。您可以在不同的网络环境中切换不同的服务器节点，以便达到更快的代理速度。</div>
             <div class="clear"></div>
           </div>

         </div>

        <form role="form">

          <div class="form-group">

            <label for="exampleInputPassword1">Shadowsocks信息：</label>

            <div class="input-group mb10">
              <span class="input-group-addon">端口号：</span>
              <input readonly type="text" class="form-control" value="<?php echo $port;?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">Shadowsocks密码：</span>
              <input readonly type="text" class="form-control" value="<?php echo base64_decode($user->ss_password);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">加密方法：</span>
              <input readonly type="text" class="form-control" value="AES-256-CFB">
            </div>

        </div>


          <div class="form-group">
            <label for="exampleInputPassword1">服务器节点信息：</label>

            <div class="input-group mb10">
              <span class="input-group-addon">日本节点地址：</span>
              <input readonly type="text" class="form-control" value="jp1.网站名称已替换.online">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">美国节点地址：</span>
              <input readonly type="text" class="form-control" value="us1.网站名称已替换.online">
            </div>

          </div>

        </form>


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  item">
          <div class="thumbnail h220">
            <?php
            // 拼接日本节点的
            $string = 'aes-256-cfb:'.base64_decode($user->ss_password).'@jp1.网站名称已替换.online:'.$port;
            $string = 'ss://'.base64_encode($string);
            echo '<img class="qr-code" src="/admin/data-api/QRCode.get.php?text='.$string.'">';
            ?>
          </div>
          <div class="my-text text-center">
            Shadowsocks客户端扫描快捷添加日本节点
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
          <div class="thumbnail h220">
            <?php
            // 拼接美国节点
            $string = 'aes-256-cfb:'.base64_decode($user->ss_password).'@us1.网站名称已替换.online:'.$port;
            $string = 'ss://'.base64_encode($string);
            echo '<img class="qr-code" src="/admin/data-api/QRCode.get.php?text='.$string.'">';
            ?>
          </div>
          <div class="my-text text-center">
            Shadowsocks客户端扫描快捷添加美国节点
          </div>
        </div>




        <?php
        } else {

        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
          <div class="conversation thumbnail" >
            <div class="order-logo">
              <img src="img/buy.png" alt="">
            </div>
            <div class="order-line">抱歉：您貌似还没有购买网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span>套餐呢。</div>
            <div class="order-line"><a href="price.php" class="btn btn-success">购买正式版</a></div>
            <div class="clear"></div>
          </div>
        </div>

        <?php
      }
        ?>

      </div>

      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>

    </div>


</main>

<section class="jumbotron">

    <p class="lead">
        <h5>不明白以上参数的含义以及如何操作？请仔细查看<a class="white-under" href="help.php">帮助</a>页面</h5>
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
