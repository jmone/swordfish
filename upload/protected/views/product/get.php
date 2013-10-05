
  <!--商品详情-->
  <div class="clear"></div>
  <div class="tanchu_box" id="tanchu_box_a">
    <div class="tanchu_box_img"><a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank"><img width="200" height="200" src="<?php echo $product['image'];?>" class="attachment-thumbnail wp-post-image" alt="" title="直达链接"></a></div>
    <div class="tanchu_box_tit">
      <ul>
        <h2><?php echo $product['title'];?></h2>
        <li>现价：<span>¥ <?php echo $product['sale_price'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo date('Y年m月d日', $product['update_time']);?>）</li>
        <li class="ja_old">原价：¥ <?php echo $product['original_price'];?></li>
        <li><div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="shareCount"></a>
</div></li>
<div class="clear"></div>
        <li class="gobuy"> <a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank">立刻去看看</a></li>
      </ul>
    </div>
  </div>
  <!--商品详情 end--> 
  <!--其他相关-->
  <div class="tanchu_box" id="tanchu_box_b">
    <?php
	if(count($moreproducts)){
	foreach($moreproducts as $product){
	?>
    <!--div class="tanchu_box_img"><a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank"><img width="200" height="200" src="<?php echo $product['image'];?>" class="attachment-thumbnail wp-post-image" alt="" title="直达链接"></a></div>-->
    <div class="tanchu_box_tit tanchu_box_tit_list">
      <ul>
          <h3><a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank"><?php echo $product['title'];?></a></h3>
        <li>现价：<span>¥ <?php echo $product['sale_price'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo date('Y年m月d日', $product['update_time']);?>）</li>
        <!--<li class="ja_old">原价：¥ <?php echo $product['original_price'];?></li>-->
      </ul>
    </div>
    <?php
	}
    }else{
        echo "其他商城暂无数据！";
    }
    ?>
  </div>
  <!--其他相关 end--> 
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->