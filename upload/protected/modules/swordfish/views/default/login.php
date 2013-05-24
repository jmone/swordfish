<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="" />
<title>欢迎登录易普搜索管理平台！</title>
<link rel="stylesheet" href="/statics/css/reset.css" />
<link rel="stylesheet" href="/statics/css/login.css" />
<script src="/statics/js/jquery.min.js"></script>
<script type="text/javascript"><!--

$(function(){
	$('#username').focus();
	$('#formLogin').submit(function(){
        $('#submitBtn').attr('disabled', 'disabled');
		$.ajax({
			type: "POST",
			url: 'index.php?module=index&do=ajaxLogin',
			data: {'username':$('#username').val(),'passwd':$('#passwd').val(),'vcode':$('#vcode').val()},
			dataType: 'json',
			success: function(rs){
				if(parseInt(rs.status) == 1)
				{
					window.location.href = rs.msg;
				}
				else if(parseInt(rs.status) == 2)
				{
                    $('#submitBtn').removeAttr('disabled');
					$('#msgBox').hide();
                    $('#msgBoxInfo').hide();
					$('#formBox').find('input').removeClass('error');
					$('.login-dialog-overlay').show();
					setObjPosition($('#mobileBox'));
					$('#mobile').focus();
				}
                else if(parseInt(rs.status) == 3)
				{
					window.location.href = "index.php?module=index&do=random";
                    return false;
				}
                else if(parseInt(rs.status) == 4)
                {
                    window.location.href = "index.php?module=index&do=random&act=verify";
                    return false;
                }
                else if (parseInt(rs.status) == 10)
                {
                    // 在主页面显示错误信息
                    $('#submitBtn').removeAttr('disabled');
					$('.login-dialog-overlay').hide();
					$('#mobileBox').hide();
                    $('#msgBox').hide();
					$('#msgBoxInfo').fadeIn();
					$('#msgBoxInfo span').html(rs.msg);

					$('#formBox').find('input').removeClass('error');
                }
				else
				{
                    $('#msgBoxInfo').hide();
                    $('#submitBtn').removeAttr('disabled');
					$('.login-dialog-overlay').hide();
					$('#mobileBox').hide();
					$('#msgBox').fadeIn();
					$('#msgBox span').html(rs.msg);

					$('#formBox').find('input').removeClass('error');

					if (rs.ext.refresh_code)
					{
						$('#vcodeImage').html('<img src="index.php?module=index&do=vcode&c=' + Math.floor(Math.random() * 1000) + '" />');
					}

					if (rs.ext.show_vcode_panel)
					{
						$('#vcodeBox').show();
					}

					if (rs.ext.highlight != undefined)
					{
						var count = rs.ext.highlight.length;
						for(var i=0; i < count; i++)
						{
							$('#' + rs.ext.highlight[i]).addClass('error');
						}
					}
				}
			}
		});
		return false;
	});

	if($('#mobileBox').is(':visible'))
	{
		$(window).resize(function(){
			setObjPosition($('#mobileBox'));
		})
	}

	// 设置对象居中
	function setObjPosition(obj)
	{
		/*var win_width = $(window).width();
		var win_height = $(window).height();
		var left = (win_width - obj.width()) / 2;
		var top  = (win_height - obj.height()) / 2;*/
		//obj.show().css({'left':left, 'top':top});
		obj.show();
	}

	$('#vcodeImage').click(function(){
		$(this).html('<img src="index.php?module=index&do=vcode&c=' + Math.floor(Math.random() * 1000) + '" />');
	});


	$('#vcode').focusin(function(){
		$.ajax({
			type: "POST",
			url: 'index.php?module=index&do=loadColor',
			data: '',
			dataType: 'json',
			success: function(rs){
				if(parseInt(rs.status) == 1)
				{
					var str = '请填写 <span style="color:'+rs.msg.value+';font-weight:bold;">'+rs.msg.name+'</span> 部分的数字';
					$('#vcodeTip').show();
					$('#vcodeTip').find('.x-tooltip-content').html(str);
				}
			}
		});
	});

	$('#vcode').focusout(function(){
		$('#vcodeTip').hide();
	});

	$('#formMobile').submit(function(){
		$.ajax({
			type: "POST",
			url: 'index.php?module=index&do=ajaxSetMobile',
			data: {'mobile':$('#mobile').val()},
			dataType: 'json',
			success: function(rs){
				if(parseInt(rs.status) == 1)
				{
					// 切换为验证码填写框
					$('#mobileBox').hide();
					$('.login-dialog-overlay').show();
					setObjPosition($('#mobileVerifyBox'));
					$('#scode').focus();
				}
				else
				{
					$('#mobileMsgBox').fadeIn();
					$('#mobileMsgBox span').html(rs.msg);

					if (rs.ext.highlight)
					{
						var count = rs.ext.highlight.length;
						for(var i=0; i < count; i++)
						{
							$('#' + rs.ext.highlight[i]).addClass('error');
						}
					}
				}
			}
		});
		return false;
	});

	$('#formSmsVerify').submit(function(){
		$.ajax({
			type: "POST",
			url: 'index.php?module=index&do=ajaxVerifySmsCode',
			data: {'scode':$('#scode').val()},
			dataType: 'json',
			success: function(rs){
				if(parseInt(rs.status) == 1)
				{
					window.location.href = "index.php?module=frame";
				}
                else if(parseInt(rs.status) == 4)
                {
                    window.location.href = "index.php?module=index&do=random&act=verify";
                    return false;
                }
                else if (parseInt(rs.status) == 10)
                {
                    // 在主页面显示错误信息
                    $('#msgBox').hide();
                    $('#mobileVerifyBox').hide();
                    $('#submitBtn').removeAttr('disabled');
					$('.login-dialog-overlay').hide();
					$('#mobileBox').hide();
					$('#msgBoxInfo').fadeIn();
					$('#msgBoxInfo span').html(rs.msg);

					$('#formBox').find('input').removeClass('error');
                }
				else
				{
					$('#scodeMsgBox').fadeIn();
					$('#scodeMsgBox span').html(rs.msg);

					if (rs.ext.highlight != undefined)
					{
						var count = rs.ext.highlight.length;
						for(var i=0; i < count; i++)
						{
							$('#' + rs.ext.highlight[i]).addClass('error');
						}
					}
				}
			}
		});
		return false;
	});
})
//
--></script>
<!--[if !IE 7]>
	<style type="text/css">
		#sticky-footer {display:table;height:100%}
	</style>
<![endif]-->
<!--[if IE]>
<link rel="stylesheet" href="/statics/css/login-ie.css" />
<![endif]-->
<link href="images/favicon.ico" rel="shortcut icon" />

</head>
<body>
    <div id="sticky-footer-outer">
        <div id="header">
            <div class="header-inner">
                <a href="./" class="logo">易普搜索管理平台</a>
                <div class="sub">
                    <h5>易普搜索管理平台</h5>
                    <h6>Swordfish manage platform</h6>
                </div>
                <!--img src="/statics/images/s.gif" class="slogan" /-->
            </div>
        </div>
        <div id="wrapper">
            <div id="login-pic"></div>
            <div id="login-box">
                <div class="title">
                    <h2>用户登录</h2>
                    <h3>请使用管理员邮箱登录</h3>
                </div>
                <div id="msgBox" class="x-msg-bar x-msg-bar-error" style="display:none;"><img src="/statics/images/s.gif" class="x-icon x-icon-red-cross" /><span>帐号信息错误</span></div>
                <div id="msgBoxInfo" class="x-msg-bar x-msg-bar-info" style="display:none;"><img src="/statics/images/s.gif" class="x-icon" /><span>帐号信息错误</span></div>
                <form method="post" action="" id="formLogin">
					<ul id="formBox">
                    <li><label>邮　箱</label><input type="text" id="username" name="username" class="email login-input" /></li>
                    <li><label>密　码</label><input type="password" id="passwd" name="passwd" class="login-input" /></li>
                    <li id="vcodeBox" class="vcode" style="display:none;">
                        <label>验证码</label><input type="text" id="vcode" name="vcode" class="login-input" /><a href="#" id="vcodeImage"><img src="index.php?module=index&do=vcode" /></a>
                        <div id="vcodeTip" class="x-tooltip x-tooltip-top" style="display:none;"><div class="x-tooltip-inner">
                            <div class="x-tooltip-content">Loading...</div>
                            <div class="x-tooltip-arrow" style="left:30px;margin-left:0;"></div>
                        </div></div>
                    </li>
                </ul>
                <div class="bot"><input type="submit" value="登 录" class="login-btn" id="submitBtn" /></div>
                </form>
            </div>
        </div>
    </div>
    <div id="footer"><div class="footer-inner">
        <ul>
            <li>&copy; 2006 - <?php echo date('Y');?> exephp.com</li>
        </ul>
        <ul style="float:right;">
            <li><a href="http://www.exephp.com">易普科技</a></li>
        </ul>
    </div></div>

    <div class="login-dialog-overlay" style="display:none;"></div>
	<div id="mobileBox" class="login-dialog" style="display:none;">
		<form method="post" action="" id="formMobile">
            <div class="login-dialog-title"><img src="/statics/images/s.gif" />请填写您的手机号码</div>
            <div class="login-dialog-content">
                <div id="mobileMsgBox" class="x-msg-bar x-msg-bar-error" style="display:none;"><img src="/statics/images/s.gif" class="x-icon x-icon-red-cross" /><span>手机号错误</span></div>
                <input type="text" name="mobile" id="mobile" class="login-input" /><input type="submit" value="提 交" class="btn" />
            </div>
		</form>
	</div>
	<div id="mobileVerifyBox" class="login-dialog" style="display:none;">
		<form method="post" action="" id="formSmsVerify">
            <div class="login-dialog-title"><img src="/statics/images/s.gif" />请填写您收到的验证码</div>
            <div class="login-dialog-content">
                <div id="scodeMsgBox" class="x-msg-bar x-msg-bar-error" style="display:none;"><img src="/statics/images/s.gif" class="x-icon x-icon-red-cross" /><span>验证码错误</span></div>
                <input type="text" name="scode" id="scode" class="login-input" /><input type="submit" value="提 交" class="btn" />
            </div>
		</form>
	</div>
</body>
</html>