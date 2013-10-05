<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?> - 查购网 - chagou.com</title>
<link type="text/css" href="/statics/style.css" rel="stylesheet" />
<script type="text/javascript" src="/statics/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/statics/chagou_ui.js" charset="utf-8"></script>
<!-- bin/jquery.slider.min.js -->
<script type="text/javascript" src="/statics/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="/statics/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="/statics/js/tmpl.js"></script>
<script type="text/javascript" src="/statics/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="/statics/js/draggable-0.1.js"></script>
<script type="text/javascript" src="/statics/js/jquery.slider.js"></script>
<!-- end -->
</head>

<body>
<!--头部-->
<div class="nav">
  <ul>
    <li>围观：</li>
    <li>新蛋</li>
    <li>京东</li>
    <li>亚马逊</li>
    <li>易迅</li>
    <li>飞虎</li>
    <li>高鸿</li>
    <li>库巴</li>
    <li>苏宁</li>
    <li>国美</li>
    <ul>
        <?php
        if (empty(Yii::app()->session['user'])) {
        ?>
        <li><a href="/user/login">登录</a></li>
        <li>|</li>
        <li><a href="/user/register">注册</a></li>
        <?php
        } else {
            //echo Yii::app()->session['user']['email'];
        ?>
        <li><a href="/user/center">个人中心</a></li>
        <li>|</li>
        <li><a href="/user/logout">注销</a></li>
        <?php
        }
        ?>
    </ul>
  </ul>
</div>
<?php echo $content; ?>
<!--底部-->
<div class="foot_no_bj foot_bj">
  <div class="foot_link">
    <ul>
      <li><a href="about.html">关于我们</a></li>
      <li><a href="#">免责声明</a></li>
      <li><a href="#">网站地图</a></li>
      <li><a href="#">友情链接</a></li>
      <li><a href="#">联系我们</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="copyright">Copyright @ 2011-2013 chagou.com 京ICP备06042871号-14</div>
</div>
<!--底部 end-->
</body>
</html>
