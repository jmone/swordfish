
  <!--商品详情-->
  <div class="clear"></div>
  <div class="tanchu_box" id="tanchu_box_a">
    <div class="tanchu_box_img"><a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank"><img width="200" height="200" src="<?php echo $product['image'];?>" class="attachment-thumbnail wp-post-image" alt="" title="直达链接"></a></div>
    <div class="tanchu_box_tit">
      <ul>
        <h2><?php echo $product['title'];?></h2>
        <li>现价：<span>¥ <?php echo $product['sale_price'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo date('Y年m月d日', $product['update_time']);?>）</li>
        <li class="ja_old">原价：¥ <?php echo $product['original_price'];?></li>
        <li class="gobuy"> <a rel="nofollow" href="<?php echo $product['url'];?>" target="_blank">立刻去看看</a></li>
      </ul>
    </div>
  </div>
  <!--商品详情 end--> 
  <!--其他相关-->
  <div class="tanchu_box" id="tanchu_box_b">
    <div class="tanchu_box_img"><a rel="nofollow" href="#" target="_blank"><img width="200" height="200" src="img/eg_pic.jpg" class="attachment-thumbnail wp-post-image" alt="" title="直达链接"></a></div>
  </div>
  <!--其他相关 end--> 