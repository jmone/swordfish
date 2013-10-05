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
                        <li<?php if( in_array(Yii::app()->controller->id, array('default')) ){echo ' class="active"';} ?>><a href="/backend/default"><i class="icon-home"></i> 首页</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webSearchFavorite')) ){echo ' class="active"';} ?>><a href="/backend/webSearchFavorite/admin"><i class="icon-sitemap"></i> 内容管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webExtDict', 'webStopWord')) ){echo ' class="active"';} ?>><a href="/backend/webExtDict/admin"><i class="icon-random"></i> 字典管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('webUser')) ){echo ' class="active"';} ?>><a href="/backend/webUser/admin"><i class="icon-user-md"></i> 用户管理</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('system')) ){echo ' class="active"';} ?>><a href="" onclick="alert('developing ...'); return false;"><i class="icon-bar-chart"></i> 统计</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('system')) ){echo ' class="active"';} ?>><a href="" onclick="alert('developing ...'); return false;"><i class="icon-eye-open"></i> 监控</a></li>
                        <li<?php if( in_array(Yii::app()->controller->id, array('system')) ){echo ' class="active"';} ?>><a href="" onclick="alert('developing ...'); return false;"><i class="icon-wrench"></i> 系统设置</a></li>
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
                }elseif( in_array(Yii::app()->controller->id, array('webSearchFavorite', 'webResourceSite', 'webCategory', 'webCategoryMapping')) ){
                ?>
                <li class="<?php if(Yii::app()->controller->id == 'webNotice' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webNotice/admin" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-info-sign"></i><i class="icon-chevron-right"></i>公告管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webNotice' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webNotice/create" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-pencil"></i><i class="icon-chevron-right"></i>发布公告</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webArtice' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webArtice/admin" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-list"></i><i class="icon-chevron-right"></i>信息管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webArtice' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webArtice/create" onclick="alert('稍后 vs 二期 ...'); return false;"><i class="icon-edit"></i><i class="icon-chevron-right"></i>发布信息</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webSearchFavorite' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webSearchFavorite/admin"><i class="icon-star"></i><i class="icon-chevron-right"></i>搜索记录收藏管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webResourceSite' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webResourceSite/admin"><i class="icon-list"></i><i class="icon-chevron-right"></i>资源站点管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webResourceSite' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webResourceSite/create"><i class="icon-plus"></i><i class="icon-chevron-right"></i>添加站点</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webCategory' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webCategory/admin"><i class="icon-list"></i><i class="icon-chevron-right"></i>分类管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webCategory' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webCategory/create"><i class="icon-plus"></i><i class="icon-chevron-right"></i>添加分类</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webCategoryMapping' && Yii::app()->controller->action->id == 'admin'){echo 'active';}?>"><a href="/backend/webCategoryMapping/admin"><i class="icon-list"></i><i class="icon-chevron-right"></i>分类映射管理</a></li>
                <li class="<?php if(Yii::app()->controller->id == 'webCategoryMapping' && Yii::app()->controller->action->id == 'create'){echo 'active';}?>"><a href="/backend/webCategoryMapping/create"><i class="icon-plus"></i><i class="icon-chevron-right"></i>添加映射关系</a></li>
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
    </body>
