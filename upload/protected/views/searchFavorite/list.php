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
<div class="clear"></div>
<!--左面-->
<div class="left_box" id="left_box">
  <div class="price" id="price" style=" height:50px;">
    <div class="price_l"></div>
    <div class="price_r"></div>
    <h2>会员中心</h2>
  </div>
  <div class="member_left">
    <ul>
      <li class="member_nav_a"><span><a href="/user/changePassword">修改密码</a></span></li>
      <li class="member_nav_b_on"><span><a href="/searchFavorite/list">收藏夹</a></span></li>
      <li class="member_nav_c"><span>系统消息</span></li>
    </ul>
  </div>
</div>
<!--左面 end--> 
<!--右面-->
<div class="right_box" id="right_box">
  <div class="favorites_right">
  <ul>
        <?php
        if (empty($favorites)) {
        ?>
            <div class="alert alert-danger">
                暂无收藏记录！
            </div>
        <?php
        } else {
        ?>
    <table width="100%" cellspacing="0" class="table_favorites">
      <tbody>
        <tr>
          <td>ID</td>
          <td>标题</td>
          <td>收藏日期</td>
          <td>操作</td>
        </tr>
        <?php
        foreach ($favorites as $favorite) {
        ?>
        <tr>
            <td><?php echo $favorite['id']; ?></td>
            <td><a href="/search?k=<?php echo $favorite['text']; ?>" target="_blank"><?php echo $favorite['text']; ?></a></td>
            <td><?php echo date('Y-m-d H:i', $favorite['dateline']); ?></td>
            <td><a href="/searchFavorite/remove?id=<?php echo $favorite['id']; ?>">删除</a></td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
        <?php
        }
        ?>
    </ul>
  </div>
</div>
<!--右面 end-->
