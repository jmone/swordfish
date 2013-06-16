<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta charset="utf-8">
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <!-- Use title if it's in the page YAML frontmatter -->
        <title>Swordfish 管理后台</title>
        <link href="/backendui/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/backendui/assets/css/bootstrap-responsive.css" rel="stylesheet">
    </head>
    <body>
        <!-- S 顶部导航 -->
        <div class="navbar navbar-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand" href="#">Swordfish 管理后台</a>
                    <ul class="nav">
                        <li<?php if( in_array(Yii::app()->controller->id, array('default')) ){echo ' class="active"';} ?>><a href="/backend/default"><i class="icon-home"></i>首页</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webSearchFavorite')) ){echo ' class="active"';} ?>><a href="/backend/webSearchFavorite/admin"><i class="icon-sitemap"></i>内容管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webExtDict', 'webStopWord')) ){echo ' class="active"';} ?>><a href="/backend/webExtDict/admin"><i class="icon-random"></i>字典管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webUser')) ){echo ' class="active"';} ?>><a href="/backend/webUser/admin"><i class="icon-user-md"></i>用户管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('system')) ){echo ' class="active"';} ?>><a href="" onclick="alert('developing ...'); return false;"><i class="icon-wrench"></i>系统设置</a></li>
                    </ul>
                    <!-- the new toggle buttons -->
                    <ul class="nav pull-right">
                        <li class="toggle-sidebar hidden-desktop"><a><i class="icon-list-alt"></i></a></li>
                        <li class="toggle-primary-sidebar hidden-desktop hidden-tablet"><a><i class="icon-th-list"></i></a></li>
                        <li class="collapsed hidden-desktop" data-toggle="collapse" data-target=".nav-collapse"><a><i class="icon-align-justify"></i></a></li>
                    </ul>
                    <div class="nav-collapse">
                        <ul class="nav full pull-right">
                            <li class="dropdown user-avatar">
                                <!-- the dropdown has a custom user-avatar class, this is the small avatar with the badge -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span>
                                        <img class="menu-avatar" src="/backendui/noavatar_small.gif" /> <span>admin <i class="icon-caret-down"></i></span>
                                        <span class="badge badge-dark-red">5</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- the first element is the one with the big avatar, add a with-image class to it -->
                                    <li class="with-image">
                                        <div class="avatar">
                                            <img src="/backendui/noavatar_middle.gif" />
                                        </div>
                                        <span>admin</span>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-user"></i> <span>个人资料</span></a></li>
                                    <li><a href="#"><i class="icon-cog"></i> <span>账户设置</span></a></li>
                                    <li><a href="#"><i class="icon-envelope"></i> <span>消息</span> <span class="label label-dark-red pull-right">5</span></a></li>
                                    <li><a href="#"><i class="icon-off"></i> <span>退出</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- E 顶部导航 -->

        <!-- S 侧边栏背景 -->
        <div class="sidebar-background"></div>
        <!-- E 侧边栏背景 -->

        <!-- S 侧边栏导航 -->
        <div class="sidebar">
            <div class="area-top">
                <ul class="inline">
                    <li>
                        <div class="avatar">
                            <img src="/backendui/noavatar_small.gif">
                        </div>
                    </li>
                    <li>
                        Welcome
                        <div class="title">admin</div>
                    </li>
                </ul>
            </div>
            <div class="divider"><span></span></div>
            <ul class="nav nav-list bs-docs-sidenav">
                <?php
                if(Yii::app()->controller->id == 'default'){
                ?>
                <li class="active"><a href="/backend/default/index"><i class="icon-home"></i><i class="icon-chevron-right"></i>欢迎页</a></li>
                <?php
                }elseif( in_array(Yii::app()->controller->id, array('webUser')) ){
                ?>
                <li class="<?php if(Yii::app()->controller->id == 'webUser' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webUser/admin"><i class="icon-user"></i><i class="icon-chevron-right"></i>用户管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webUser' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webUser/create"><i class="icon-plus"></i><i class="icon-chevron-right"></i>添加用户</a></li>
                <?php
                }elseif( in_array(Yii::app()->controller->id, array('webExtDict', 'webStopWord')) ){
                ?>
                <li class="<?php if(Yii::app()->controller->id == 'webExtDict' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webExtDict/admin"><i class="icon-book"></i><i class="icon-chevron-right"></i>扩展字典管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webExtDict' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webExtDict/create"><i class="icon-plus"></i><i class="icon-chevron-right"></i>添加扩展词</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webStopWord' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webStopWord/admin"><i class="icon-stop"></i><i class="icon-chevron-right"></i>停止词管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webStopWord' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webStopWord/create"><i class="icon-remove-sign"></i><i class="icon-chevron-right"></i>添加停止词</a></li>
                <?php
                }elseif( in_array(Yii::app()->controller->id, array('webSearchFavorite')) ){
                ?>
                <li class="<?php if(Yii::app()->controller->id == 'webNotice' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webNotice/admin" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-info-sign"></i><i class="icon-chevron-right"></i>公告管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webNotice' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webNotice/create" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-pencil"></i><i class="icon-chevron-right"></i>发布公告</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webArtice' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webArtice/admin" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-list"></i><i class="icon-chevron-right"></i>信息管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webArtice' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webArtice/create" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-edit"></i><i class="icon-chevron-right"></i>发布信息</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webSearchFavorite' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webSearchFavorite/admin"><i class="icon-star"></i><i class="icon-chevron-right"></i>搜索记录收藏管理</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <!-- E 侧边栏导航 -->
        <!-- S 主要内容区域 -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="area-top">
                        <div class="hidden pull-left header">
                            <i class="icon-edit icon-2x"></i>
                            <span class="title">主要内容区域</span>
                        </div>
                        <ul class="num-stats pull-right">
                            <li class="hidden stat-red">
                                <ul class="inline">
                                    <li class="hidden-phone glyph">
                                        <i class="icon-money"></i>
                                    </li>
                                    <li>
                                        <span class="number">$44.233</span> 总收入
                                    </li>
                                </ul>
                            </li>
                            <li class="stat-green">
                                <ul class="inline">
                                    <li class="hidden-phone glyph">
                                        <i class="icon-ok-circle"></i>
                                    </li>
                                    <li>
                                        <span class="number">1513</span> 商品总收录数
                                    </li>
                                </ul>
                            </li>
                            <li class="stat-blue">
                                <ul class="inline">
                                    <li class="hidden-phone glyph">
                                        <i class="icon-plus"></i>
                                    </li>
                                    <li>
                                        <span class="number">5305</span> 今日访问量
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="breadcrumb-line navbar">
                        <ul class="breadcrumbs pull-left">
                            <li><a href="#"><i class="icon-home"></i>首页</a></li>
                            <li class="current"><i class="icon-edit"></i> 欢迎页</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php echo $content;?>
        </div>
        <!-- E 主要内容区域 -->
        
        <!-- Le javascript ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <!-- 通过CAT合并 UGLIFY 压缩BOOTSTRAP内置JS插件 包含以下文件 
        jquery.js bootstrap-transition.js bootstrap-alert.js bootstrap-modal.js bootstrap-dropdown.js bootstrap-scrollspy.js bootstrap-tab.js bootstrap-tooltip.js bootstrap-popover.js bootstrap-button.js bootstrap-collapse.js bootstrap-carousel.js bootstrap-typeahead.js bootstrap-datepicker.js bootstrap-datepicker.zh-CN.js-->
        <script src="/backendui/assets/js/bootstrap.min.js"></script>

        <!-- 表单美化插件 -->
        <script src="/backendui/assets/js/jquery.uniform.js"></script>
        <!-- 非常强大的SELECT插件 http://ivaynberg.github.io/select2/ -->
        <script src="/backendui/assets/js/select2.js"></script>
        <!-- jquery 日历插件 -->
        <script src="/backendui/assets/js/jquery.validationEngine.js"></script>
        <script src="/backendui/assets/js/jquery.validationEngine-zh_CN.js"></script>
        <!-- 用来生成静态或动态波谱图表效果 -->
        <script src="/backendui/assets/js/jquery.sparkline.js"></script>
        <!-- 多功能表格插件 -->
        <script src="/backendui/assets/js/jquery.dataTables.js"></script>
        <!-- 相册 支持TOUCH -->
        <script src="/backendui/assets/js/touchTouch.jquery.js"></script>
        <!-- 泡泡消息 -->
        <script src="/backendui/assets/js/jquery.gritter.js"></script>
        <!-- highcharts绘图 包含highcharts.js exporting.js -->
        <script src="/backendui/assets/js/highcharts.js"></script>
        <script src="/backendui/assets/js/exporting.js"></script>

        <script type="text/javascript">
         $(function(){

             //dataTables
                 $(".dTable,.dTable-small").dataTable({
                     bJQueryUI:!1,
                     bAutoWidth:!1,
                     bSortClasses: true,
                     sPaginationType:"full_numbers",
                     sDom:'<"table-header"fl>t<"table-footer"ip>'});
 
                 $("select.uniform, .check, .check :checkbox, input:radio, input:file, .dataTables_length select").uniform();
                     $(".chzn-select").select2();
                     $("form.validatable").validationEngine({promptPosition:"topLeft"});
                 $(".datepicker").datepicker({todayBtn:!0});

                 //touchTouch thumbs show
                 $("#thumbs a").touchTouch();

             //bar progress
             $(".bar-progress .tip").each(function(){
                 var e,t;
                 return t=Math.floor(Math.random()*80)+20,
                 e=""+t+"%",
                 $(this).attr("title",e).attr("data-percent",t).attr("data-original-title",e).css({width:e})
             })
             //easypiechart
                     function getRandomInt(e,t){return Math.floor(Math.random()*(t-e+1))+e}
                     var Theme ={
                     colors:{
                             red:"#db6464",green:"#96c877",blue:"#6e97aa",orange:"#ff9f01",gray:"#ccc",lightBlue:"#D4E5DE"
                     }
             };
             var t=[];
    	
                     setInterval(function(){
                 return $(t).each(function(){return this.refresh(getRandomInt(0,80))})
             },2500)

             //gritter growl plugin
                     var Growl=function(){
                             var e = this;
                             return e.info=function(e){return e.class_name="info",e.title="<i class='icon-info-sign'></i> "+e.title,$.gritter.add(e)},
                             e.warn=function(e){return e.class_name="warn",e.title="<i class='icon-warning-sign'></i> "+e.title,$.gritter.add(e)},
                             e.error=function(e){return e.class_name="error",e.title="<i class='icon-exclamation-sign'></i> "+e.title,$.gritter.add(e)},
                             e.success=function(e){return e.class_name="success",e.title="<i class='icon-ok-sign'></i> "+e.title,$.gritter.add(e)},e
                     }();
                     $.extend($.gritter.options,{position:"bottom-right"})

                     $(".growl-info").click(function(e){
                             return e.preventDefault(),Growl.info({title:"This is a notice!",text:"This will fade out after a certain amount of time."})
                     });
                     $(".growl-warn").click(function(e){
                             return e.preventDefault(),Growl.warn({title:"This is a warning!",text:"This will fade out after a certain amount of time."})
                     });
                     $(".growl-error").click(function(e){
                             return e.preventDefault(),Growl.error({title:"This is an error!",text:"This will fade out after a certain amount of time."})
                     });
                     $(".growl-success").click(function(e){
                             return e.preventDefault(),Growl.success({title:"This is a success message!",text:"This will fade out after a certain amount of time."})
                     });
    	
             //用户展示说明
                     var pageView = {
                             channelPosition:function(){
                         var boxsArray = [];
                         for(var i=1;i<7;i++){
                             var objPos =$(".pageViewPop_"+i).offset().top;
                             boxsArray.push(objPos);
                         }
                         return boxsArray;
                     },
                     animateScroll:function(posid){
                         var boxypos = this.channelPosition(),
                             scrollT = boxypos[posid];
                         var obj = document.body;
                         $(obj).animate({scrollTop:scrollT},1000);
                     }
                     }
                      $(".bs-docs-sidenav").find("a").bind("click",function(){
                     $(".bs-docs-sidenav").find("li").removeClass("active");
                             $(this).parent().addClass("active");
                         return false;

                 });

    	

             //绘图展示
             $('#hightcharts_combin').highcharts({
                 chart: {
                 },
                 title: {
                     text: '综合绘图'
                 },
                 xAxis: {
                     categories: ['苹果', '橘子', '香蕉', '李子', '梨']
                 },
                 tooltip: {
                     formatter: function() {
                         var s;
                         if (this.point.name) { // the pie chart
                             s = ''+
                                 this.point.name +': '+ this.y +' 消费水果占比';
                         } else {
                             s = ''+
                                 this.x  +': '+ this.y;
                         }
                         return s;
                     }
                 },
                 labels: {
                     items: [{
                         html: '水果消费总量',
                         style: {
                             left: '40px',
                             top: '8px',
                             color: 'black'
                         }
                     }]
                 },
                 series: [{
                     type: 'column',
                     name: '汤汤',
                     data: [3, 2, 1, 3, 4]
                 }, {
                     type: 'column',
                     name: '',
                     data: [2, 3, 5, 7, 6]
                 }, {
                     type: 'column',
                     name: '飞飞',
                     data: [4, 3, 3, 9, 0]
                 }, {
                     type: 'spline',
                     name: '平均',
                     data: [3, 2.67, 3, 6.33, 3.33],
                     marker: {
                             lineWidth: 2,
                             lineColor: Highcharts.getOptions().colors[3],
                             fillColor: 'white'
                     }
                 }, {
                     type: 'pie',
                     name: 'Total consumption',
                     data: [{
                         name: '汤汤',
                         y: 13,
                         color: Highcharts.getOptions().colors[0] // Jane's color
                     }, {
                         name: '超超',
                         y: 23,
                         color: Highcharts.getOptions().colors[1] // John's color
                     }, {
                         name: '飞飞',
                         y: 19,
                         color: Highcharts.getOptions().colors[2] // Joe's color
                     }],
                     center: [100, 80],
                     size: 100,
                     showInLegend: false,
                     dataLabels: {
                         enabled: false
                     }
                 }]
             });
                     $('#hightcharts_pieA').highcharts({
                                 chart: {
                                     plotBackgroundColor: null,
                                     plotBorderWidth: null,
                                     plotShadow: false
                                 },
                                 title: {
                                     text: '某某网站用户浏览器统计-2012'
                                 },
                                 tooltip: {
                                         pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                                     percentageDecimals: 1
                                 },
                                 plotOptions: {
                                     pie: {
                                         allowPointSelect: true,
                                         cursor: 'pointer',
                                         dataLabels: {
                                             enabled: true,
                                             color: '#000000',
                                             connectorColor: '#000000',
                                             formatter: function() {
                                                 return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                                             }
                                         }
                                     }
                                 },
                                 series: [{
                                     type: 'pie',
                                     name: '占比',
                                     data: [
                                         ['Firefox',   45.0],
                                         ['IE',       26.8],
                                         {
                                             name: 'Chrome',
                                             y: 12.8,
                                             sliced: true,
                                             selected: true
                                         },
                                         ['Safari',    8.5],
                                         ['Opera',     6.2],
                                         ['Others',   0.7]
                                     ]
                                 }]
                             });
                             $('#hightcharts_pieB').highcharts({
                 chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: null,
                     plotShadow: false
                 },
                 title: {
                     text: '某某网站用户浏览器统计-2012'
                 },
                 tooltip: {
                         pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                     percentageDecimals: 1
                 },
                 plotOptions: {
                     pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                             enabled: false
                         },
                         showInLegend: true
                     }
                 },
                 series: [{
                     type: 'pie',
                     name: '占比',
                     data: [
                         ['Firefox',   45.0],
                         ['IE',       26.8],
                         {
                             name: 'Chrome',
                             y: 12.8,
                             sliced: true,
                             selected: true
                         },
                         ['Safari',    8.5],
                         ['Opera',     6.2],
                         ['Others',   0.7]
                     ]
                 }]
             });
                     $('#hightcharts_column').highcharts({
                 chart: {
                     type: 'bar'
                 },
                 title: {
                     text: 'Historic World Population by Region'
                 },
                 subtitle: {
                     text: 'Source: Wikipedia.org'
                 },
                 xAxis: {
                     categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
                     title: {
                         text: null
                     }
                 },
                 yAxis: {
                     min: 0,
                     title: {
                         text: 'Population (millions)',
                         align: 'high'
                     },
                     labels: {
                         overflow: 'justify'
                     }
                 },
                 tooltip: {
                     valueSuffix: ' millions'
                 },
                 plotOptions: {
                     bar: {
                         dataLabels: {
                             enabled: true
                         }
                     }
                 },
                 legend: {
                     layout: 'vertical',
                     align: 'right',
                     verticalAlign: 'top',
                     x: -100,
                     y: 100,
                     floating: true,
                     borderWidth: 1,
                     backgroundColor: '#FAFAFA',
                     shadow: true
                 },
                 credits: {
                     enabled: false
                 },
                 series: [{
                     name: 'Year 1800',
                     data: [107, 31, 635, 203, 2]
                 }, {
                     name: 'Year 1900',
                     data: [133, 156, 947, 408, 6]
                 }, {
                     name: 'Year 2008',
                     data: [973, 914, 4054, 732, 34]
                 }]
             });
     //sparkline
             return $(".sparkline").each(function(){
                 var e,t,n,r;
                 return n=$(this).attr("data-color")||"red",
                 r="18px",
                 $(this).hasClass("big")&&(t="5px",e="2px",r="30px"),
                 $(this).sparkline("html",{type:"bar",barColor:Theme.colors[n],height:r,barWidth:t,barSpacing:e,zeroAxis:!1})
             })
         })
        </script>
    </body>
