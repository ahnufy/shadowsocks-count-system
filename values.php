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
    <title>网站名称已替换VPN翻墙、VPN怎么用--愿景和信念 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>努力让更多人可以自由上网</h4>
    </p>

</header>

<main class="container">

    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="row my-pic-row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation thumbnail" >
                    <div class="avatar">
                      <img src="img/head/laowai.png" alt="">
                    </div>
                    <div class="say"><span>某国际留学生：</span>“我是来自法国的Tom，在北京语言大学学习汉语，我不知道为什么Twitter经常上不去，我喜欢刷Twitter来看看国内正在流行什么，网站名称已替换刚好解决了我的问题。”</div>
                    <div class="clear"></div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation right thumbnail" >
                    <div class="avatar">
                      <img src="img/head/teacher.png" alt="">
                    </div>
                    <div class="say"><span>某知名教授：</span>“我是中国矿业大学的教授，国内网络环境有时候很糟糕，我需要使用谷歌学术来帮忙我进行科研，网站名称已替换速度不错，并且有两条线路，学校和家里我都能选择最快的线路。”</div>
                    <div class="clear"></div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation thumbnail" >
                    <div class="avatar">
                      <img src="img/head/mom.jpeg" alt="">
                    </div>
                    <div class="say"><span>某年轻妈妈：</span>“孩子出国后念高中，微信就用的少了，转而用 Facebook 了，作为妈妈当然想关心孩子的动态，网站名称已替换能让我及时跟踪孩子的成长情况。”</span></div>
                    <div class="clear"></div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation right thumbnail" >
                    <div class="avatar">
                      <img src="img/head/boss.png" alt="">
                    </div>
                    <div class="say"><span>某私营企业老板：</span>“我是一家外贸公司的负责人，公司规模不大但是在6个国家有业务，和客户沟通，GMail 是非常重要的方式，网站名称已替换能让我及时和服务客户，间接增强企业竞争力。”</span></div>
                    <div class="clear"></div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation thumbnail" >
                    <div class="avatar">
                      <img src="img/head/girl.png" alt="">
                    </div>
                    <div class="say"><span>某恋爱中的女青年：</span>“都说异地恋很艰辛，异国恋更是。男友在硅谷工作，难得见面一次，还好有网站名称已替换这样的服务商，让我和男朋友保持各种互动，哪怕相隔万里，感情也不减分。”</div>
                    <div class="clear"></div>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                  <div class="conversation right thumbnail" >
                    <div class="avatar">
                      <img src="img/head/it.png" alt="">
                    </div>
                    <div class="say"><span>某IT男青年：</span>“作为苦逼的码农，每天下班后看看美剧别提多棒了，国内的网站美剧资源少，Youtube 是我的最爱，一边看剧一边学习英语，真是一举两得呢，网站名称已替换的服务很棒，看高清也不卡。”</div>
                    <div class="clear"></div>
                  </div>
                </div>



            </div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

    </div>

</main>

<section class="jumbotron">

    <p class="lead" style="padding-left:1020px;">
        <h5>互联网应该自由的属于每个人。基于这样的信念，我们承诺：捐出5%的营收，帮助更多山区儿童访问网络。</h5>
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
