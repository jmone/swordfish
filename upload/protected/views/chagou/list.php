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
    <form role="search" method="get" id="searchform" action="/search">
      <input type="hidden" value="<?php echo $searchData['original'][0];?>" name="k" />
      <div class="price_box_a">价格过滤：价格区间（元）</div>
      <!--筛选空间-->
      <input id="Slider1" type="slider" name="price" value="<?php echo $price;?>" />
      <!--筛选空间--> 
      <script type="text/javascript" charset="utf-8">
      jQuery("#Slider1").slider({ from: 0, to: 100000, step: 50, smooth: true, round: 0, dimension: "&nbsp;￥", skin: "plastic" });
      </script>
    </form>
    </div>
  </div>
  <div class="favorite_share">
      价格排序：<a href="/search?k=<?php echo $searchData['original'][0];?>&price=<?php echo $price;?>&priceorder=asc">由低到高</a> | <a href="/search?k=<?php echo $searchData['original'][0];?>&price=<?php echo $price;?>&priceorder=desc">由高到低</a>
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
    <div class="favorite_share">
        <!--同商品不同商城推荐-->
        <p><a href="/searchFavorite/add?k=<?php echo $searchData['original'][0];?>" target="_blank">立即收藏该搜索结果</a></p>
        <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style">
            <span class="jiathis_txt">分享到：</span>
            <a class="jiathis_button_icons_1"></a>
            <a class="jiathis_button_icons_2"></a>
            <a class="jiathis_button_icons_3"></a>
            <a class="jiathis_button_icons_4"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
        </div>
        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
        <!-- JiaThis Button END -->
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
                foreach($searchData['docsid'] as $docid){
                    $product = $products[$docid];
                ?>
  <!--内容循环-->
  <div class="list_box">
    <div class="list_box_img"><img width="80" height="80" src="<?php echo $product['image'];?>" onerror="this.src='/statics/images/none.gif'" class="attachment-thumbnail wp-post-image" alt="" title="<?php echo $product['title'];?>"></div>
    <div class="list_box_tit">
      <ul>
        <li>
          <h2><a href="/jump/product/idstr/<?php echo $product['id'];?>" target="_blank" title="现价：￥<?php echo $product['sale_price'];?>， 原价：￥<?php echo $product['original_price'];?>" class="product_title"><?php echo $product['title'];?></a></h2>
        </li>
        <li>商品价格：<span>¥ <?php echo $product['sale_price'];?></span></li>
        <li class="fenlei">商品分类：<a href="/">默认分类</a>&nbsp;&nbsp;&nbsp;&nbsp;所属商城：<a href="/jump/url/goto/dangdang" target="_blank">当当</a></li>
        <li class="gobuy"> <a rel="nofollow" href="#" id="<?php echo $product['id'];?>" class="tc_js">查看详情</a> <a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank">优惠直达</a> </li>
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
    			echo "<a href=\"/search?k={$searchData['original'][0]}&price=$price&priceorder=$priceOrder&page=$i\" class=\"page larger\">{$i}</a>";
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

<script language="javascript">
function highlight(key) {
        var key = key.split('|');
        var titles = document.getElementsByClassName('product_title');
        for (var i=0; i<key.length; i++){
                var pa = new RegExp("("+key[i]+")","ig");
                for(var j=0; j<titles.length; j++){
                        titles[j].innerHTML = titles[j].innerHTML.replace(pa, "<span style=\"color:green;\">"+key[i]+"</span>");
                }
        }
}
var keystr = '<?php echo implode('|', $searchData['words']);?>';
highlight(keystr);
</script>
