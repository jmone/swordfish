<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容查询页 - 查购网</title>
<link type="text/css" href="/statics/style.css" rel="stylesheet" />
<script type="text/javascript" src="/statics/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	 $("#select ul li").each(function(i){
		$(this).hover(function(){
			$(this).addClass("on").siblings().removeClass("on");
			$(".tanchu_box:eq("+i+")").show().siblings(".tanchu_box").hide();
		})
	 })
})
</script>
</head>

<body>
<div class="tanchu_cn"> 
  <!--滑动门-->
  <div class="select" id="select">
    <ul>
      <li class="on"><a href="#" title="刚刚发表的信息">商品详情</a></li>
      <li class="off"><a href="#" title="高热度的信息">其他相关</a></li>
    </ul>
  </div>
  <!--滑动门 end-->
  <?php echo $content;?>
</div>
</body>
</html>