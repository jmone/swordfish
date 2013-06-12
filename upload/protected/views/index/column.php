<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?> - <?php echo CHtml::encode(Yii::app()->name);?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/statics/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="page-header container-fluid">
            <div class="row-fluid">
                <div class="span6">
                    <a href="/">首页</a>
                    <a href="">有奖爆料</a>
                    <a href="">降价排行榜</a>
                    <a href="">商家导航</a>
                </div>
                <div class="span6 text-right">
                    <?php
                    if(empty(Yii::app()->session['user'])){
                    ?>
                    <a href="/user/login">登录</a>
                    <a href="/user/register">注册</a>
                    <?php
                    }else{
                        echo Yii::app()->session['user']['email'];
                    ?>，<a href="/user/logout">注销</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <?php echo $content; ?>
        </div>

        <div class="clear"></div>

        <div id="footer" class="text-center">
            <a href="">关于我们</a> - <a href="">人才招聘</a> - <a href="">市场合作</a> - <a href="">开放接口</a> - <a href="">友情链接</a> - <a href="">站点统计</a><br />
            Copyright &copy; <?php echo date('Y'); ?> 电商比价搜索. All Rights Reserved.<br/>
            Powered by <a href="http://www.exephp.com/" rel="external">Swordfish</a>.
        </div>
    </body>
</html>



