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
<!--左面-->
<div class="left_box" id="left_box">
  <div class="price" id="price">
    <div class="price_l"></div>
    <div class="price_r"></div>
    <div id="price_box">
      <div class="price_box_a">价格过滤：价格区间（元）</div>
      <!--筛选空间-->
      <input id="Slider1" type="slider" name="price" value="9000.5;70000" />
      <!--筛选空间--> 
      <script type="text/javascript" charset="utf-8">
      jQuery("#Slider1").slider({ from: 0, to: 100000, step: 50, smooth: true, round: 0, dimension: "&nbsp;￥", skin: "plastic" });
    </script> 
    </div>
  </div>
  <div class="mall_shop">
    <h2>商城过滤：</h2>
    <ul>
      <li>新蛋</li>
      <li class="jd">京东</li>
      <li class="ymx">亚马逊</li>
      <li class="yixun">易迅</li>
      <li class="taobao">淘宝</li>
      <li class="suning">苏宁</li>
      <li class="dangdang">当当</li>
      <li class="yihao">一号店</li>
    </ul>
  </div>
</div>
<!--左面 end--> 
<!--右面-->
<div class="right_box" id="right_box">
<?php
if(empty($products)){
?>
<div class="alert alert-danger">
    未找到相关商品
</div>
<?php
}else{
?>
                <?php
                foreach($products as $product){
                ?>
  <!--内容循环-->
  <div class="list_box">
    <div class="list_box_img"><img width="80" height="80" src="http://img.rehui.net/upfiles/2013/06/180337_1-150x150.jpg" onerror="this.src='/statics/images/none.gif'" class="attachment-thumbnail wp-post-image" alt="" title="直达链接"></div>
    <div class="list_box_tit">
      <ul>
        <li>
          <h2><a href="<?php echo $product['url'];?>" target="_blank" title="现价：￥<?php echo $product['sale_price'];?>， 原价：￥<?php echo $product['original_price'];?>"><?php echo $product['title'];?></a></h2>
        </li>
        <li>商品价格：<span>¥ <?php echo $product['sale_price'];?></span></li>
        <li class="fenlei">商品分类：<a href="/">数码相机</a>&nbsp;&nbsp;&nbsp;&nbsp;所属商城：<a href="/">苏宁易购</a></li>
        <li class="gobuy"> <a rel="nofollow" href="#" id="tanchu02" class="tc_js">查看详情</a> <a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank">优惠直达</a> </li>
      </ul>
    </div>
  </div>
  <!--内容循环 end-->
                <?php
                }
                ?>
  <!--分页-->
  <div class="more_posts">
    <div class="wp-pagenavi">
        <!--
        <span class="current">1</span>
        <a href="#/page/2/" class="page larger">2</a>
        <a href="#/page/3/" class="page larger">3</a>
        <a href="#/page/4/" class="page larger">4</a>
        <a href="#/page/5/" class="page larger">5</a>
        <span class="extend">..</span>
        <a href="#/page/10/" class="larger page">10</a>
        <span class="extend">..</span>
        <a href="#/page/2/" class="nextpostslink">下一页</a>
        <a href="#/page/560/" class="last">560</a>
        -->
	<?php
		for($i = 1; $i <= ceil($searchData['original'][1]/$searchData['original'][3]); $i++){
                    if($searchData['original'][2] == $i){
                        echo "<span class=\"current\">$i</span>";
                    }else{
    			echo "<a href=\"/search?k={$searchData['original'][0]}&page=$i\" class=\"page larger\">{$i}</a>";
                    }
                }
	?>
    </div>
  </div>
  <!--分页 end-->
<?php
}
?>
</div>
<!--右面 end--> 
<!--弹出提示-->
<div id="tishi"></div>
<!--弹出提示 end-->