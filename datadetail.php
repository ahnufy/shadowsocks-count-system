<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/config/api.config.php';
require './admin/dao/User.class.php';
require './admin/dao/UserPort.class.php';
require './admin/dao/UserData.class.php';
require './admin/dao/Node.class.php';
require './admin/lib/data_formater.php';
require './admin/lib/http.php';

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

$Node = new Node($servername, $username, $password, $dbname);

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
    <title>网站名称已替换VPN--流量统计 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>查看您的流量记录</h4>
    </p>

</header>

<main class="container">

    <div class="row">

      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>

      <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">


        <?php


        if (sizeof($json_by_uid_result->data) > 0) {

          // 注释掉，加快访问速度
          // get($api.'/admin/action/sync_data.php');
          // sleep(0.5); // 等待一秒钟，以便同步到数据库

          $user_port = $json_by_uid_result->data[0];


          $sum = 0;
          $jp = null;
          $us = null;

          // 从结果里面查找日本节点和美国节点，计算总流量
          foreach ($json_by_uid_result->data as $value) {
            $sum+=$value->in_data;
            $sum+=$value->out_data;

            $node_result = $Node->get_by_id($value->ip_id);

            $json_node_result = json_decode($node_result);

            if ($json_node_result->data[0]->ip == '45.76.220.48') {
              $jp = $value;
            }

            if ($json_node_result->data[0]->ip == '45.32.137.40') {
              $us = $value;
            }

          }

          // 需要去拿套餐信息呢
          $UserData = new UserData($servername, $username, $password, $dbname);
          $user_data_result = $UserData->get_by_uid($_SESSION['userid']);
          $json_user_data_result = json_decode($user_data_result);

          $user_data = $json_user_data_result->data[0];

        ?>

        <form role="form">


          <div class="form-group">
            <label for="exampleInputPassword1">套餐信息：</label>

            <div class="input-group mb10">
              <span class="input-group-addon">套餐到期时间：</span>
              <input readonly type="text" class="form-control" value="<?php echo $user_data->expires_time;?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">套餐包含总流量：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($user_data->data_limit);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">套餐流量已使用：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($sum);?>">
            </div>

          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">日本节点流量详情：</label>

            <div class="input-group mb10">
              <span class="input-group-addon">进网流量：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($jp->in_data);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">出网流量：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($jp->out_data);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">总计：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($jp->in_data + $jp->out_data);?>">
            </div>

          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">美国节点流量使用详情：</label>

            <div class="input-group mb10">
              <span class="input-group-addon">进网流量：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($us->in_data);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">出网流量：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($us->out_data);?>">
            </div>

            <div class="input-group mb10">
              <span class="input-group-addon">总计：</span>
              <input readonly type="text" class="form-control" value="<?php echo data_formater($us->in_data + $us->out_data);?>">
            </div>

          </div>

        </form>

        <?php
      } else {

        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
          <div class="conversation thumbnail" >
            <div class="order-logo">
              <img src="img/buy.png" alt="">
            </div>
            <div class="order-line">购买并激活一个订单后就会得到相关信息</div>
            <div class="order-line"><a href="price.php" class="btn btn-success">购买</a></div>
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
        <h5>提示：系统流量统计可能和您本地的流量统计存在一定误差，以本系统为准</h5>
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
