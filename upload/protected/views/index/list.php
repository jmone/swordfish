
<div class="row-fluid">
    <div class="span4"><h4>比价搜索</h4></div>
    <div class="span8 text-right">
        <form class="form-search" method="GET" action="/search">
            <input type="text" name="k" class="input-xxlarge" value="<?php echo $searchData['original'][0];?>">
            <button type="submit" class="btn">比价搜索</button>
        </form>
    </div>
</div>
<?php
if(empty($products)){
?>
<div class="alert alert-danger">
    未找到相关商品
</div>
<?php
}else{
?>
<div class="alert alert-info">
    找到<?php echo $searchData['original'][1];?>个相关商品
</div>
<div class="row-fluid">
    <div class="span10">
        <table class="table">
            <thead>
                <tr>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>运费</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($products as $product){
                ?>
                <tr>
                    <td class="thumbnails">
                        <img src="./pic/t123.jpg" width="100" height="100" onerror="this.src='/statics/images/none.gif'" class="thumbnail" />
                    </td>
                    <td><a href="<?php echo $product['url'];?>" target="_blank"><?php echo $product['title'];?></a></td>
                    <td>现价：￥<?php echo $product['sale_price'];?>， 原价：￥<?php echo $product['original_price'];?></td>
                    <td>满80元免</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="span2">
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
<?php
}
?>