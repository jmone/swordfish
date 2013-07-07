<?php
switch ($type){
    case 'success':
        $class = 'alert-success';
        break;
    case 'error':
        $class = 'alert-error';
        break;
    default :
        $class = 'alert-info';
}
?>
<div class="header">
  <div id="logo"><a href="/" title="查购网" class="logo">查购网</a></div>
  <div class="search">
    <form role="search" method="get" id="searchform" action="/search">
      <p>
        <input type="text" onfocus="this.value=(this.value=='请输入你要查询的商品...')?'':this.value" onblur="this.value=(this.value=='')?'请输入你要查询的商品...':this.value" value="<?php echo $searchData['original'][0];?>" name="k" id="s" class="search_a">
        <input type="submit" id="searchsubmit" class="search_b" value="搜 索">
      </p>
    </form>
  </div>
</div>
<!--头部 end--> 
<!--登录-->
<div class="clear"></div>
<!--登录 end--> 
<div class="common_message">
<ul>
<h2>提示信息</h2>
<li><?php echo $message;?></li>
</ul>
</div>
