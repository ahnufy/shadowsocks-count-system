<?php
// require './admin/config/debug.config.php';
require './admin/config/db.config.php';
require './admin/dao/User.class.php';

$email = '';

if(isset($_GET['r'])){

    // 读取推荐者的email 信息，并且设置 cookie
    $User = new User($servername, $username, $password, $dbname);
    $by_id_result = $User->get_by_id($_GET['r']);
    $json_by_id_result = json_decode($by_id_result);

    if(sizeof($json_by_id_result->data) > 0){
      $email = $json_by_id_result->data[0]->email;
      setcookie("r", $email, time() + 3600 * 24 * 365);
    }

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
    <title>网站名称已替换VPN--用户注册 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
                    <a href="login.html">登录网站名称已替换</a>
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
        <h4>现在就注册 网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span></h4>
    </p>

</header>

<main class="container">

    <div class="row">

      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>

      <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">

        <form role="form">

          <div class="form-group">
            <label for="exampleInputEmail1">用户名：</label>
            <input type="text" class="form-control" id="username" placeholder="你在本站的昵称">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">电子邮箱：</label>
            <input type="email" class="form-control" id="email" placeholder="收不到邮件请查看垃圾箱或更换邮箱">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">邮箱验证码：</label>
            <div class="input-group">
              <input type="number" class="form-control" id="code" placeholder="获取后请查看邮箱">
              <span class="input-group-addon" id="sendCode" style='cursor:pointer;'>获取验证码</span>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">密码：</label>
            <input type="password" class="form-control" id="password" placeholder="账户登录密码">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">确认密码：</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="确认登录密码">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">邀请者邮箱：</label>

            <input type="email" placeholder="填写邀请者，双方获收益，没有可不填" class="form-control" id="recommenderEmail" value='<?php echo $email; ?>'>

          </div>

          <a href="javascript:void(0)" class="btn btn-success" id='reg'>立即注册</a>
          <a href="login.html" class="btn btn-info">登录网站名称已替换</a>

        </form>

      </div>

      <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>


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
<script src="js/api.js"></script>
<script src="js/jquery.slid.min.js"></script>

<script>
  window.onload = function () {

    var sendCode = document.getElementById('sendCode');
    var email = document.getElementById('email');
    var username = document.getElementById('username');
    var code = document.getElementById('code');
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirmPassword');
    // var ssPassword = document.getElementById('ss_password');
    var recommenderEmail = document.getElementById('recommenderEmail');
    var reg = document.getElementById('reg');

    var emailRegx = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;


    function getCookie(name) {
      var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
      if(arr = document.cookie.match(reg)) {
        return unescape(arr[2]);
      } else {
        return null;
      }
    }

    // 读取 cookie 写入input
    if (getCookie('r')) {
      recommenderEmail.value = getCookie('r');
    }

    sendCode.onclick = function () {

      if (email.value !=='' && email.value.match(emailRegx)) {

        $.get(api.emailCode,
          {
            to:
            email.value
          },
          function(data){

          alert(data.msg);

        }, "json");

      } else {
        alert('输入的邮箱不正确！请检查！');
      }
    }

    reg.onclick = function () {

      if (username.value !== '' && email.value !=='' && code.value !=='' && password.value !=='' && confirmPassword.value !=='') {

        if (password.value !== confirmPassword.value) {
          alert('两次密码输入不一致!请检查！');
          return;
        }

        if (recommenderEmail.value == email.value || (recommenderEmail.value != '' && !recommenderEmail.value.match(emailRegx))) {
          alert('推荐邮箱和注册邮箱不可相同！并且要求为正确邮箱格式！');
          return;
        }

        $.get(api.userReg,
          {
            username: username.value,
            email: email.value,
            password: password.value,
            // ss_password: ssPassword.value,
            code: code.value,
            recommender_email: recommenderEmail.value,
          },
          function(data){

          if (data.code == 0) {
            alert('注册成功!请登录！');
            window.location.href = api.url + '/login.html';
          } else {
            alert(data.msg);
          }

        }, "json");

      } else {
        alert('输入信息不正确或不完善！请检查！');
      }
    }

  };
</script>

</html>
