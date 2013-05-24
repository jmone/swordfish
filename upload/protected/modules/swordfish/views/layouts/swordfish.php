
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="description" content="" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Cache-control" content="no-cache">
<title>易普搜索管理平台</title>
<link rel="stylesheet" href="/statics/css/reset.css" />
<link rel="stylesheet" href="/statics/css/widget.css" />
<link rel="stylesheet" href="/statics/css/layout.css" />
<link rel="stylesheet" href="scripts/jquery-ui/css/cupertino/jquery-ui-1.8.18.custom.css" />
<link href="images/favicon.ico" rel="shortcut icon" />
<script src="/statics/js/jquery.min.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="./scripts/pad/sorter.js"></script>
<script src="/statics/js/frame.js"></script>
<script type="text/javascript" src="/statics/js/hint.js"></script>
<script src="/statics/js/forbidden_copy.js"></script>

<script src="scripts/jquery-ui/js/jquery.datepicker.js"></script>
<script type="text/javascript" src="scripts/highcharts/highcharts.js"></script>
<script type="text/javascript" src="scripts/highcharts/exporting.js"></script>
<script type="text/javascript" src="scripts/highcharts/grid.js"></script>
<script type="text/javascript" src="scripts/pc/jquery.selection.js"></script>
<script type="text/javascript" src="scripts/pc/jquery.caret.js"></script>
<script type="text/javascript" src="scripts/pc/jquery.checkInput.js"></script>


<script type="text/javascript" src="./scripts/jquery.livequery.js"></script>

<style>
    .x-tbl table {background-image:url(index.php?module=index&do=waterPng);}
</style>

<!--[if IE]>
<link rel="stylesheet" href="/statics/css/ie.css" />
<script type="text/javascript" src="scripts/jquery.placeholder.1.3.min.js"></script>
<script type="text/javascript" src="scripts/pc/ie.js"></script>
<script>
    $(document).ready(function(){
        $.Placeholder.init();
    });
</script>
<![endif]-->
<style>
    .x-menu-switch-btn:link,
    .x-menu-switch-btn:visited {position:absolute; left:160px; bottom:0; display:block; width:15px; height:28px; border:1px solid #BDD5EE; border-left:0; background:url(/statics/images/menu-switch-btn.gif); z-index:9;}
    .x-menu-switch-btn:hover {border-color:#8Eb5DC;}
    .x-menu-switch-btn:active {background-position:-15px 0;}
    
    .x-menu-switch-btn-left:link,
    .x-menu-switch-btn-left:visited {left:0; background-position:-30px 0;}
    .x-menu-switch-btn-left:hover {border-color:#8Eb5DC;}
    .x-menu-switch-btn-left:active {background-position:-45px 0;}
</style>

<script>
    //菜单开关效果
    $(document).ready(function(){
        //将所有二级菜单关闭
        /*
        $('#menu li[has_child=1] ul').each(function(){
            if ($(this).find('li.current').length==0)
            {
                $(this).hide();
            }
            else
            {
                $(this).prev('a.collapse').addClass('collapse-down');
            }
        });
        */
       
        // 有输入的情况，将body快捷键感知关闭
        $('input[type=text],textarea').live('focus', function(){
            $('body').attr('quick_sense', 0);
        }).live('blur', function(){
            $('body').attr('quick_sense', 1);
        });
       
        // 默认控制面板时打开下面第一菜单
        if ($('.jq-default').parent('li').is('.current'))
        {
            var $first = $('.jq-default').parent().next('li');
            if ($first.length !== 0)
            {
                $first.children('a').addClass('collapse-down');
                $first.children('ul').show();
            }
        }

        //点击一级菜单动作
        $('#menu li[has_child=1] a.collapse').click(function(){
            if ($(this).hasClass('collapse-down'))
            {
                $(this).removeClass('collapse-down');
                $(this).next('ul').slideUp('fast');
            }
            else
            {
                $(this).addClass('collapse-down');
                $(this).next('ul').slideDown('fast');
            }
        });
        
        /*----- 开关菜单栏 start -----*/
        // 开关菜单栏
        $('.x-menu-switch-btn').click(function(){
            switchMenu();
        });
        
        // 滚动条滚动，菜单切换按钮保持在底部
        $(window).bind('scroll', function(){
            // webkit弹性滚动处理
            if (jQuery.browser.webkit && ($(window).height() >= $('#main').height() || ($(this).scrollTop() + $(window).height()) > $(document).height()))
            return false;
            $('.x-menu-switch-btn').css('bottom', '-' + $(this).scrollTop() + 'px');
        });
        /*----- 开关菜单栏  end  -----*/
        
        // 快捷键操作，点击U
        $(document).keypress(function(e){
            if ($('body').attr('quick_sense')==1)
            {
                //alert(e.which);
                if (e.which == 117) // U
                {
                    switchMenu();
                }
            }
        });
    });
    
    // 开关菜单栏
    function switchMenu()
    {
        if ($('.x-menu-switch-btn').hasClass('x-menu-switch-btn-left'))
        {
            $('.x-menu-switch-btn').removeClass('x-menu-switch-btn-left').attr('title', '关闭菜单(U)');
            $('body').css('background-image', 'url(/statics/images/bg.gif)');
            $('#sidebar').show();
            $('#main').css('margin-left', '160px');
            
            var fix_cap_margin_left = 170;
        }
        else
        {
            $('.x-menu-switch-btn').addClass('x-menu-switch-btn-left').attr('title', '打开菜单(U)');
            $('body').css('background-image', 'none');
            $('#sidebar').hide();
            $('#main').css('margin-left', '0');
            
            var fix_cap_margin_left = 10;
        }
        
        // 如果存在固定表头，则修改固定表头的宽度
        if ($('.x-tbl-caption-fixed').length == 1)
        {
            var fix = $('.x-tbl-caption-fixed').attr('fix');
            var fix_tbl_width = $('.x-tbl:not(.x-tbl-fixed)[fix=' + fix + ']').width();
            $('.x-tbl-caption-fixed').css('margin-left', fix_cap_margin_left + 'px');
            $('.x-tbl-caption-fixed .x-tbl').css('width', fix_tbl_width + 'px');
        }
    }
</script>

</head>


<body quick_sense="1">

    <a href="javascript:;" title="关闭菜单(U)" class="x-menu-switch-btn"></a>
    
    <div id="header">
        <a href="./index.php" class="logo">易普搜索管理平台</a>
        <div class="r">您好，<strong>蒋明！</strong>[ <a href="index.php?module=index&do=logout">安全退出</a> ]</div>
    </div>    
    <div id="sidebar"><!--菜单-->
        <ul id="menu">
        <li id="item_20"  has_child="1" class="current"> <a href="index.php?module=frame&do=index" highlight="20" class="jq-default"><img src="images/s.gif" class="x-icon x-icon-home" />控制面板</a></li>
        <li id="item_554"  has_child="1">
            <a href="javascript:;" highlight="554" class="collapse"><img src="images/s.gif" class="x-icon x-icon-fcode" />词典管理</a>
            <ul id="group_554" pid="554" style="display:none" >
                <li id="item_555" > <a href="index.php?module=fcode-getFcode&do=index" highlight="555" ><img src="images/s.gif" class="" />默认词典</a></li>
                <li id="item_555" > <a href="index.php?module=fcode-getFcode&do=index" highlight="555" ><img src="images/s.gif" class="" />扩展词典</a></li>
                <li id="item_555" > <a href="index.php?module=fcode-getFcode&do=index" highlight="555" ><img src="images/s.gif" class="" />停止词</a></li>
                <li id="item_555" > <a href="index.php?module=fcode-getFcode&do=index" highlight="555" ><img src="images/s.gif" class="" />拼音映射</a></li>
                <li id="item_555" > <a href="index.php?module=fcode-getFcode&do=index" highlight="555" ><img src="images/s.gif" class="" />近义词</a></li>
            </ul>
        </li>
        <li id="item_499"  has_child="1">
            <a href="javascript:;" highlight="499" class="collapse"><img src="images/s.gif" class="x-icon x-icon-fcode" />索引管理</a>
            <ul id="group_499" pid="499" style="display:none" >
                <li id="item_528" > <a href="index.php?module=miboss-iweek&do=index" highlight="528" ><img src="images/s.gif" class="" />iWeek</a></li>
            </ul>
        </li>
        <li id="item_499"  has_child="1">
            <a href="javascript:;" highlight="499" class="collapse"><img src="images/s.gif" class="x-icon x-icon-fcode" />爬虫管理</a>
            <ul id="group_499" pid="499" style="display:none" >
                <li id="item_528" > <a href="index.php?module=miboss-iweek&do=index" highlight="528" ><img src="images/s.gif" class="" />iWeek</a></li>
            </ul>
        </li>
        <li id="item_499"  has_child="1">
            <a href="javascript:;" highlight="499" class="collapse"><img src="images/s.gif" class="x-icon x-icon-fcode" />缓存管理</a>
            <ul id="group_499" pid="499" style="display:none" >
                <li id="item_528" > <a href="index.php?module=miboss-iweek&do=index" highlight="528" ><img src="images/s.gif" class="" />iWeek</a></li>
            </ul>
        </li>
        <li id="item_499"  has_child="1">
            <a href="javascript:;" highlight="499" class="collapse"><img src="images/s.gif" class="x-icon x-icon-fcode" />运行状态</a>
            <ul id="group_499" pid="499" style="display:none" >
                <li id="item_528" > <a href="index.php?module=miboss-iweek&do=index" highlight="528" ><img src="images/s.gif" class="" />iWeek</a></li>
            </ul>
        </li>
        </ul>
    </div>
    
    <div id="main">
        
<script>
    $(document).ready(function(){
        //如果没有快捷按钮，就显示占位图片
        if ($('ul.x-page-shortcut li').length == 0)
        {
            $('ul.x-page-shortcut').hide();
            $('ul.x-page-shortcut').prev('.x-page-simple-title').hide();
            $('.jq-dd').show();
        }
        // IE6提示
        if ($.browser.msie && ($.browser.version == "6.0") && !$.support.style)
        {
            $('.x-page-ie6').show();
        }
        
        // 快捷按钮繁简切换
        // $('.x-page-shortcut li').addClass('simple');
        
    });
</script>

<style>
    .x-page-simple-title { margin-top:10px; height:31px; line-height:31px; font-size:14px; color:#666; border-bottom:1px solid #DDD; }

    .x-page-shortcut { margin-bottom:20px; width:100%; overflow:auto; }
    .x-page-shortcut li { position:relative; float:left; margin:10px 10px 0 0; height:62px; }
    .x-page-shortcut li img { position:absolute; top:6px; left:6px; display:block; width:48px; height:48px; }

    .x-page-shortcut a {position:relative; display:block; padding-left:60px; width:120px; height:60px; color:#666; border:1px solid #DCE7F0; border-radius:5px; overflow:auto; text-decoration:none; background:url(images/pc/main-shortcut-bg.gif);}
    .x-page-shortcut a:hover {border-color:#CCDCEA; background-position:0 -125px;}
    .x-page-shortcut a:active {background-position:0 -250px;}
    .x-page-shortcut h2 {margin-top:7px; height:24px; line-height:24px; font-size:14px;}
    .x-page-shortcut h3 {height:20px; line-height:20px; font-size:12px; font-weight:normal; color:#999;}
    
    .x-page-shortcut li.simple { height:40px; overflow:hidden; }
    .x-page-shortcut li.simple img { width:26px; height:26px; }
    .x-page-shortcut li.simple a { padding-left:38px; height:38px; }
    .x-page-shortcut li.simple h3 { display:none; }
    
    .x-page-ie6 {display:none; position:relative; margin-top:10px; padding-left:84px; height:84px; border:1px solid #E19C47; background:#FFFFC0;}
    .x-page-ie6 img {position:absolute; top:10px; left:10px; display:block; width:64px; height:64px; background:url(/statics/images/noie6.gif);}
    .x-page-ie6 h2 {margin-top:12px; height:30px; line-height:30px; font-size:20px; color:#999;}
    .x-page-ie6 h3 {line-height:30px; font-size:16px; color:#333;}
    .x-page-ie6 h3 a {color:#C00; text-decoration:underline;}
</style>

<div class="x-page-ie6">
    <img src="images/s.gif" />
    <h2>Out了吧！您的浏览器版本太低啦...</h2>
    <h3>立即升级IE浏览器，或使用其他内核浏览器（如：<a href="http://google.com/chrome/" target="_blank">Chrome</a>），获得更好的浏览体验。</h3>
</div>

<h2 class="x-page-simple-title">快捷入口</h2>

<ul class="x-page-shortcut">
    <li>
        <a href="index.php?module=fcode-getFcode&do=getFcode">
            <img src="images/pc/icon48/icon48-fcode.png" />
            <h2>爬虫管理</h2>
            <h3>监控、管理爬虫状态</h3>
        </a>
    </li>
    <li>
        <a href="index.php?module=fcode-getFcode&do=getFcode">
            <img src="images/pc/icon48/icon48-fcode.png" />
            <h2>扩展分词词典</h2>
            <h3>自定义分词词典管理</h3>
        </a>
    </li>
    <li>
        <a href="index.php?module=fcode-getFcode&do=getFcode">
            <img src="images/pc/icon48/icon48-fcode.png" />
            <h2>索引管理</h2>
            <h3>索引查看、优化</h3>
        </a>
    </li>
</ul>

<h2 class="x-page-simple-title">常用功能</h2>

<ul class="x-page-shortcut">
    <li>
        <a href="javascript:;">
            <img src="images/pc/icon48/icon48-chrome.png" />
            <h2>停止词</h2>
            <h3>管理您的停止词</h3>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="images/pc/icon48/icon48-gvim.png" />
            <h2>缓存管理</h2>
            <h3>缓存使用状态管理</h3>
        </a>
    </li>
</ul>


<div class="jq-dd" style="display:none;">
    <img src="images/s.gif" class="jq-dd" style="display:block;margin:100px auto 0;width:280px;height:370px;background:url(images/mitu-danding.jpg);" />
</div>    </div>
    
    <style>
        .jq-x-foot-tools-html {display:none;}
        .x-foot-tools {position:fixed; bottom:-1px; right:0; height:42px;}
        .x-foot-tools li {float:left; width:40px; height:40px; border:1px solid #999; border-right:0; background:#DCDCDC url(images/pc/foot-tools-bg.png) top repeat-x; opacity:0.7;}
        .x-foot-tools li:hover {opacity:1;}
        .x-foot-tools li a {display:block; width:40px; height:40px; background-image:url(images/pc/foot-tools-bg.png);}
        .x-foot-tools li:first-child,
        .x-foot-tools li:first-child a {border-radius:5px 0 0 0;}
        .x-foot-tools li a:hover {background-color:#FFF;}
        .x-foot-tools li a.hint {background-position:0 -80px;}
        .x-foot-tools li a.hint:hover {background-position:0 -120px;}
        .x-foot-tools li a.go2top {background-position:0 -160px;}
        .x-foot-tools li a.go2top:hover {background-position:0 -200px;}
        .x-foot-tools li a.fullscreen {background-position:0 -240px;}
        .x-foot-tools li a.fullscreen:hover {background-position:0 -280px;}
        .x-foot-tools li a.play-add {background-position:0 -560px;}
        .x-foot-tools li a.play-add:hover {background-position:0 -600px;}
        .x-foot-tools li a.play-del {background-position:0 -640px;}
        .x-foot-tools li a.play-del:hover {background-position:0 -680px;}
    </style>
    <ul class="x-foot-tools"></ul>
    
</body>
</html>