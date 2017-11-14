<?php

// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';

session_start();

if(!isset($_SESSION['userid'])){
    header("Location:havenotlogin.php");
}

require './admin/dao/Seo.class.php';
$Seo = new Seo($servername, $username, $password, $dbname);
$seo_by_id_result = $Seo->get_all();
$json_seo_by_id_result = json_decode($seo_by_id_result);


$user = new User($servername, $username, $password, $dbname);

$user_result = $user->get_by_id($_SESSION['userid']);

$json_user_result = json_decode($user_result);

// var_dump($json_user_result);

// 得到邮箱，从邮箱再去检索推荐的人

$user_recommend_result = $user->get_by_recommender_email($json_user_result->data[0]->email);

$json_user_recommend_result = json_decode($user_recommend_result);

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
    <title>网站名称已替换VPN--推荐记录|更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>查看和管理你的所有推荐</h4>
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
                    <img src="img/user.png" alt="">
                  </div>
                  <div class="order-line">用户通过点击你的专属推荐连接注册，或者注册时候填写你的注册邮箱，你就成为他的推荐者！并能获取对应收益！</div>
                  <div class="clear"></div>
                </div>
                <div class="input-group mb10">
                  <span class="input-group-addon">我的推荐链接：</span>
                  <input type="text" class="form-control" value="https://网站名称已替换.org/reg.php?r=<?php echo $_SESSION['userid'];?>">
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                <div class="thumbnail h220">
                  <?php
                  echo '<img class="qr-code" src="/admin/data-api/QRCode.get.php?text=https://网站名称已替换.org/reg.php?r='.$_SESSION['userid'].'">';
                  ?>
                </div>
                <div class="my-text text-center">
                  我的推荐链接二维码，右键或长按可保存到本地，尽情分享给需要的小伙伴吧
                </div>
              </div>

              <?php

              for ($i =0; $i < sizeof($json_user_recommend_result->data); $i++) {

              ?>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">
                <div class="conversation thumbnail" >
                  <div class="order-logo">
                    <img src="img/person.png" alt="">
                  </div>
                  <div class="order-line">
                    <?php
                    echo '用户名：'.$json_user_recommend_result->data[$i]->username;
                    echo '，邮箱：'.$json_user_recommend_result->data[$i]->email."<br>";
                    echo '注册时间：'.$json_user_recommend_result->data[$i]->reg_time;
                    echo '，消费状态：未知';
                    ?>
                  </div>
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
        <h5>提示：邀请用户激活收益的功能正在开发中，您现在的邀请所得收益，在功能开放后便可获得，请放心邀请。</h5>
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
function del () {
  alert('delete');
}

function activate (id) {
  $.get(api.url + '/admin/data-api/Order.activate.php',
    {
      id: id
    },
    function(data){

      if (data.code == 0) {
        alert('激活订单成功！请前往用户中心查看 Shadowsocks 信息！');
        window.location.href = 'user.php';
      } else {
        alert(data.msg);
      }

    }, "json");
}
</script>

</html>
