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
    <title>网站名称已替换VPN是什么、VPN下载--使用帮助 | 更快速的VPN, 更稳定的ShadowSocks</title>

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
        <h4>常见问题的答案，都在这里</h4>
    </p>

</header>

<main class="container">

  <div class="row">

      <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0"></div>

      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

          <div class="row my-pic-row">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                  <div class="my-text big-text">
                      一、Shadowsocks 简介
                  </div>
                  <div class="gray-text">

                    <div class="title">（1）Shadowsocks是什么？</div>
                    Shadowsocks是一款安全，快速，广受欢迎的代理软件。<br>

                    <div class="title">（2）Shadowsocks用来干什么？</div>
                    Shadowsocks客户端用来将你的请求通过加密隧道转发到目标机器，由目标机器的Shadowsocks服务端请求所需资源后再转发回来。用网络用语通俗的说：“翻墙”----也就是用来访问类似于 google.com、youtube.com、facebook.com 等网站。<br>

                    <div class="title">（3）Shadowsocks四要素是什么？</div>
                    对于客户端而言：服务器地址、服务器端口号、加密方法以及密码构成一个完整的解决方案，拥有这四要素便可以使用任何 Shadowsocks 客户端来代理访问。<br>

                    <div class="title">（4）为什么说Shadowsocks是安全的？</div>
                    端到端加密，多种加密方式可选，让通过 Shadowsocks 代理的所有流量都处于加密状态，只有服务器拥有和客户端相匹配的密钥，才能解密。因而，Shadowsocks 也常用来加密请求，比如公共免费 WIFI 环境下使用 Shadowsocks 可以基本杜绝网络劫持。<br>

                    <div class="title">（5）Shadowsocks这么好用，都支持哪些平台呢？</div>
                    Shadowsocks属于开源软件，官方支持 Windows，Linux，Mac，Android，iOS，OpenWrt等几乎所有平台，并且有非官方的多个版本可选。<br>
                  </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                  <div class="my-text big-text">
                      二、Shadowsocks 常见平台推荐版本
                  </div>
                  <div class="gray-text">
                    <div class="title">（1）Windows 操作系统</div>
                    请安装官方最新版本的 Shadowsocks 客户端，你可能需要安装本软件的依赖.net 环境，请按照提示安装即可。下载链接：<a href="download/Shadowsocks.exe">点击这里</a><br>

                    <div class="title">（2）Mac 操作系统：</div>
                    请安装官方最新版本的 Shadowsocks-NG 客户端，下载链接：<a href="download/ShadowsocksX.zip">macOS Sierra之前系统</a>，<a href="download/ShadowsocksX-NG-1.4-beta.zip">macOS Sierra系统</a><br>

                    <div class="title">（3）iOS 操作系统：</div>
                    请在 APP Stroe 里面搜索“Shadowrocket”或者“Wingy”，前者收费人民币18元，后者免费，均可使用------因政策原因，已经屏蔽【2017年6月，可用路由器方式代替；或者在其他平台使用】【目前可使用 ShadoWingy代替，暂未屏蔽】。<br>

                    <div class="title">（4）Android 操作系统：</div>
                    请安装官方最新版本的 Shadowsocks 客户端，下载链接：<a href="download/shadowsocks-nightly-4.0.3.apk">点击这里</a>，如果你使用微信打开本页面，请在浏览器中打开以便能使用下载功能。<br>

                    <div class="title">（5）路由器 Open WRT 操作系统：</div>
                    在路由器上使用 Shadowsocks后，这个路由器的网络就全部拥有了翻墙能力，这属于高端技巧。【注意：不是所有路由器均支持该功能】<br>
                  </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                  <div class="my-text big-text">
                      三、网站名称已替换 使用流程
                  </div>
                  <div class="gray-text">

                    <div class="title">（1）购买：</div>
                    在用户注册登录后，点击导航栏“套餐价格”，根据自己的需要，购买一个 网站名称已替换 套餐。如果你参与“朝阳计划”，请按照要求进行邮件沟通，无需购买。<br>

                    <div class="title">（2）激活：</div>
                    购买套餐后，点击对应订单的“激活”按钮，便可激活这个套餐，激活后，将得到 Shadowsocks 的账户信息。如果你参与“朝阳计划”，无需购买和激活，便直接能在 Shadowsocks 账户里查看免费服务器信息。<br>

                    <div class="title">（3）使用：</div>
                    在您的个人中心——>Shadowsocks 账户中，将得到的四要素也就是服务器地址，服务器端口号，加密方法，密码填写到 Shadowsocks 客户端的对应位置并选择该服务器然后启动即可。<br>

                    <div class="title">（4）快捷设置方式：</div>
                    在您的个人中心——>Shadowsocks 账户中，默认有两个服务器节点，您可以使用移动设备上安装的 Shadowsocks 客户端直接扫描二维码即可成功导入设置；对于桌面设备：你可以使用从屏幕扫描二维码功能。<br>


                    <div class="title">（4）还有困惑？</div>
                    其他说明信息、安装步骤截图、简单使用方法以及高阶用户向导，<strong>请在登录后，重新查看本页面的后续内容</strong>。为了在遇到问题的时候你知道是什么原因，你应该仔细阅读本页面上的所有内容。<br>
                  </div>
              </div>


              <?php
               if (isset($_SESSION['userid'])) {
                ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        四、阅读下文详细说明前的重要提示
                    </div>
                    <div class="gray-text">

                      <div class="title">（1）账户无法使用</div>
                      任何时候，你的账户一旦无法使用，请先查看个人中心的套餐统计页面，查看流量是否用完、日期是否到期。如果套餐流量用完或者过期，请重新购买；否则，请与我们联系。<br>

                      <div class="title">（2）法律相关问题</div>
                      做为一个使用 Shadowsocks 的用户，相信你对相关法律，政策已经有所了解和思考。既然你选择了使用本站提供的服务，那么你应该遵从本站的法律要求，和你个人所在国，服务器所在国的法律要求。不可使用本站服务从事任何违法犯罪的行为，如有违反，后果自负。请每一位用户严肃谨慎，不要浏览，转发，评论相关违法犯罪的内容。<br>

                      <div class="title">（3）帐号分享问题</div>
                      如果你没有购买本站套餐，你将拥有一个免费服务器的配置帐号，此帐号你可以任意分享。一旦你购买了本站套餐，你将拥有一个双线服务器配置帐号，此帐号不可分享。因为：你的套餐不仅有时间限制，更有流量限制，二者任何一个超出限制就会停机。而你无法确保你分享出去的帐号不会被再次分享。为了限制用户分享帐号的行为，我们不允许用户修改 Shadowsocks 密码，一旦分享出去，其他用户就可以永久使用你的帐号，会造成你帐号流量的大幅浪费甚至停机。<br>

                      <div class="title">（4）停止服务与退款问题</div>
                      任何一家 Shadowsocks服务提供商都有可能面临关闭的可能。我们建议用户按月和半年购买。如果有一天我们决定停止服务，我们会在半年前发出公告，停止服务后如有用户多余款项，我们会原渠道退款，敬请放心。<br>

                      <div class="title">（5）网站名称已替换很好用，我想让更多人使用</div>
                      谢谢你的支持，你的支持和期许是我们前进的动力，我们非常欢迎你来邀请新用户，你的每一个邀请都会在系统有记录。系统会针对你邀请的用户的消费情况，给予你对应的奖励。但是请记住，分享给需要的人，比海量分享更有效率，更能帮助到需要的人。我们再次感谢你的支持，正是用户的支持，让我们努力做好。<br>

                    </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        五、Shadowsocks 使用过程中遇到的常见问题
                    </div>
                    <div class="gray-text">

                      <div class="title">（1）密码填写错误</div>
                      请确保你的密码填写没有错误，请着重注意，此密码是你的“个人中心”栏目下“Shadowsocks账户”模块下显示的“Shadowsocks 密码”，不是你的登录密码！<br>

                      <div class="title">（2）加密方法勾选错误：</div>
                      网站名称已替换&trade;&nbsp;<span style='font-size:12px;'>网站名称已替换</span> 采用安全、可靠、广受赞誉的 AES-256-CFB 加密方法来进行加密，请确保客户端选择与此一致。如果在将来加密方法发生改变导致无法登录，我们将邮件通知你，请注意查看收件箱或者垃圾箱。你在任何时候一旦无法使用请第一时间登录本站查看你的账户信息和系统通知。<br>

                      <div class="title">（3）代理功能未打开</div>
                      大多数版本在你填写完 Shadowsocks 信息后，并不会为你自动打开代理功能，你需要在确保服务器选择正确的前提下打开代理功能便可以使用。<br>

                      <div class="title">（4）服务器未勾选</div>
                      大多数版本在你填写完 Shadowsocks 信息后，并不一定会为你选择服务器，你可能需要手动勾选服务器然后打开代理方可使用。<br>

                      <div class="title">（5）如何确定代理成功</div>
                      在浏览器地址栏输入<a href="https://www.google.com">https://www.google.com</a>，点击确定能够正常访问即代理成功。<br>

                      <div class="title">（6）为何手机能够正常代理而电脑不可以</div>
                      电脑日常使用较多，系统设置复杂，你的网络设置可能损坏或者不正确，切记：有任何一台设备能够正常代理成功，均表示我们的服务没有任何问题。<br>

                      <div class="title">（7）为何网站名称已替换用起来有时快有时慢</div>
                      很抱歉，这是属于国际带宽资源有限的问题。无论你用哪一家 VPN 提供商的服务，都会遇到这个问题，无论他宣称的速度有多快。因为中国的宽带进出口是固定的，用的人多了，自然就慢，这是任何人也改变不了的事实。网站名称已替换为了提供最好的服务，选择了目前能找到的最快的机器，但是依旧受限于中国国际带宽的限制。为了优化这个问题，网站名称已替换已经使用谷歌开源的网络流量控制协议 BBR 来加速了访问。一般而言，傍晚速度比较慢；夜里是可以支持 YouTube 的 4K 甚至 8K 视频播放的。<br>

                      <div class="title">（8）为何打开国内的网站特别慢</div>
                      你极有可能打开了 Shadowsocks 的全局代理而未关闭，关于全局代理或者局部代理的区别，请谷歌搜索。<br>

                      <div class="title">（9）我确定一切填写正确但是还是无法使用</div>
                      只有两种情况：一、你真的信息填写错误，请仔细核对或者使用二维码扫描的功能；二、你的网络情况非常糟糕，你的宽带提供商可能正巧封锁了你正在使用的端口，请尝试更换网络环境比如在移动网络和宽带网络中切换。<br>

                      <div class="title">（10）我之前使用正常但是现在不正常</div>
                      出现此类问题，首先查看个人中心的套餐统计，查看自己的套餐时间是否到期？流量是否超限？如果确定均没有问题，请留意个人中心系统通知和邮件提醒，我们可能有维护服务器或者更换服务器，邮件通知请留意垃圾箱。如果以上两种情况都没有问题，请重新查看此页面的更新内容，我们可能在此页面发布重要通知。<br>

                      <div class="title">（11）我在 Windows 平台安装 Shadowsocks 的时候，提示我安装 .net Framework</div>
                       .net Framework 是微软的基础软件库，Shadowsocks 有依赖这个软件库，根据提示下载安装对应版本即可，然后再打开 Shadowsocks 便能正常使用。<br>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        六、Windows 设备以 Shadowsocks 为例讲解如何设置和使用
                    </div>
                    <div class="gray-text">

                      <div class="title">Shadowsocks为 Shadowsocks 官方提供的 PC(Windows) 平台的版本</div>

                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Windows/1.JPG">
                            <div class="caption">
                              <h4>1.下载软件</h4>
                              <p>解压后看到如图所示界面，示例图片显示为4.0.5版本。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Windows/2.JPG">
                            <div class="caption">
                              <h4>2.双击打开软件，开始添加节点</h4>
                              <p>如图，将个人中心中Shadowsocks账户提供的端口、密码、加密算法和服务器地址到对应位置即可，然后确定即可。重复此步骤，以添加多条服务器线路。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Windows/3.JPG">
                            <div class="caption">
                              <h4>3.勾选服务器节点</h4>
                              <p>有些版本不会为你自动默认勾选服务器，你可能需要手动勾选一个服务器。提示：在不同的网络环境中，比如公司和家里、联通和电信，不同的节点访问速度有差异，你可以通过测试选择更快的节点使用。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Windows/4.JPG">
                            <div class="caption">
                              <h4>4.启用系统代理</h4>
                              <p>如图，请确保“启用系统代理”项已经勾选，有些版本不会为你自动启用，你可能需要手动启用。此时，便可以进行访问测试了。其他高阶使用方法，请见本页后续内容。</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        七、iOS 设备以 Shadowrocket 为例讲解如何设置和使用
                    </div>
                    <div class="gray-text">

                      <div class="title">我们不提供相关程序，因为Shadowsocks的开源特性，市场上有足够多的兼容客户端可选。我们推荐安装 Shadowrocket 或者 Wingy，我们以 Shadowrocket 为例。</div>

                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/iOS/1.jpeg">
                            <div class="caption">
                              <h4>1.安装客户端软件</h4>
                              <p>请从 APP Store 里面安装 Shadowrocket，免费的 Wingy 的设置也基本相同，可以参考本教程进行设置。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/iOS/2.jpeg">
                            <div class="caption">
                              <h4>2.新建服务器节点</h4>
                              <p>点击右上角的加号，新建一个服务器。默认你有两台服务器，端口、密码、加密算法完全一样只有服务器地址不同。或者点击左上角的方框按钮扫描你账户信息下方的二维码快捷设置。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/iOS/3.jpeg">
                            <div class="caption">
                              <h4>3.填写Shadowsocks</h4>
                              <p>在个人中心查看Shadowsocks账户，填写端口、密码、加密算法和服务器地址到对应位置即可，然后保存即可。注意：请不要勾选一次性认证。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/iOS/4.jpeg">
                            <div class="caption">
                              <h4>4.打开代理</h4>
                              <p>点击上方的蓝色开关按钮，打开代理，就可以了。你应该在第一次打开代理后，使用谷歌进行访问测试。</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        八、Mac 设备以 Shadowsocks-NG 为例讲解如何设置和使用
                    </div>
                    <div class="gray-text">

                      <div class="title">Shadowsocks-NG为 Shadowsocks 官方的 Mac 平台的新一代版本</div>

                      <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Mac/1.png">
                            <div class="caption">
                              <h4>1.下载软件</h4>
                              <p>单击打开后会在系统顶栏看到如图所示界面</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Mac/2.png">
                            <div class="caption">
                              <h4>2.添加服务器节点</h4>
                              <p>如图，鼠标挪到服务器选项，在菜单里面点击服务器设置。或者点击“扫描屏幕上的二维码”功能直接扫描，切记：你需要保持你的账户信息中的二维码无遮盖的出现在屏幕上。</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Mac/3.png">
                            <div class="caption">
                              <h4>3.填写Shadowsocks</h4>
                              <p>点击加号，将个人中心中Shadowsocks账户提供的端口、密码、加密算法和服务器地址到对应位置即可，然后确定即可。注意：请不要勾选：启用 OTA.</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <img src="img/help/Mac/4.png">
                            <div class="caption">
                              <h4>4.打开代理</h4>
                              <p>如图，请确保服务器已经勾选，Shadowsocks 状态为已经打开。</p>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item">

                    <div class="my-text big-text">
                        九、高阶使用技巧
                    </div>
                    <div class="gray-text">

                      <div class="title">本节相关的高级功能，非专业用户可以不专注</div>

                      <div class="row">

                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <div class="caption">
                              <h4>1.支持 IPV6</h4>
                              <p>最新版本的 Shadowsocks 客户端，均支持 IPV6，IPV6是下一代网络地址协议，目前还未广泛使用。现阶段，国内有不少教育网内的 PT 分享站基于 IPV6搭建，比如知名的“北邮人论坛“，<a href="http://bt.byr.cn/">http://bt.byr.cn/</a>，你可以通过 IPV6网络下载其中的海量资源，前提是：你需要一个该站的帐号并且拥有 IPV6网络。教育网默认拥有 IPV6网络，离开学校后，目前公网还未普及 IPV6。现在，你只要在 shadowsocks 中打开“全局模式“，你就可以登录此网站，然后使用常见 BT 客户端比如 uTorrent 来下载了。注意，uTorrent 需要设置相应的网络代理。</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <div class="caption">
                              <h4>2.转换成全局 http 代理</h4>
                              <p>我们知道，Shadowsocks 是建立在 socks5协议之上的加密隧道，然而并不是所有的软件，比如浏览器，或者常见的游戏软件等都支持 socks5代理的，那么，我们可以使用相应的软件Privoxy，将 socks5协议转换成几乎所有支持代理功能软件都支持的 http 协议，然后就能愉快的使用代理功能了。关于Privoxy的详细使用教程，请参考官网的说明文档，如有疑问，可以百度搜索相关问题。</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <div class="caption">
                              <h4>3.全局和局部（PAC）模式的切换</h4>
                              <p>我们知道，Shadowsocks 的一大特色，就是可以区分被屏蔽与未被屏蔽的网址。他是如何实现的呢？Shadowsocks 通过下载远程的 gfwlist 来实现这个功能。此 gfwlist 由开源社区维护，当一个网址被屏蔽后，就有热心的开发者将此网址加入 gfwlist。因此你可以经常更新此 gfwlist，菜单里面的“更新PAC“功能就是这个意思。然而，开源社区并不能保证所有的网址都在此 gfwlist 中，因此，当你打开某些国外的被屏蔽网址时候，局部（PAC）模式并不能打开，因而你可以切换到全局模式，访问完毕后再切换回局部模式。此方法也适用于未被屏蔽但是在国内访问速度慢或这不稳定的网站。</p>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                          <div class="thumbnail">
                            <div class="caption">
                              <h4>4.手动维护本地的 PAC 文件（gfwlist）</h4>
                              <p>上一条说到，开源社区无法保证所有被屏蔽的网址都能加入此列表，有所遗漏很正常。针对这个问题，Shadowsocks 提供了用户自定义的模式，你可以手动添加某些网址到此列表中。关于此列表文件的语法规范，相信作为高阶用户的你，是能够搞定的。如果遇到问题，建议谷歌搜索，都能得到解决方案。如果你是普通用户，为了防止出现问题，请不要随意操作此文件。</p>
                            </div>
                          </div>
                        </div>

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

    <p class="lead" style="padding-left:1020px;">
        <h5>还有其他问题？请与我们邮件联系：<a class="white-under" href="mailto:postmaster@网站名称已替换.org">postmaster@网站名称已替换.org</a>。</h5>
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
