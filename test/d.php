<?php
define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'global.func.php';

$url = "http://category.dangdang.com/cid4008122.html";
//$url = "http://category.dangdang.com/all/?category_path=01.03.51.00.00.00";
//$url = "http://e.dangdang.com/list_98.01.23.00.htm";
$content = callback($url);
$content = iconv('GBK', 'UTF-8', $content);

if( preg_match('|(http://e\.dangdang\.com/list_.*)\.htm|', $url, $url_info) ){

	if(preg_match('|<input type="hidden" name="totalPage" value="([0-9]*)"/>|isU', $content, $page_info)){
		$max_page = intval($page_info[1]);
	}
	//print_r($url_info);
	//print_r($page_info);

		for($i=1; $i<=1; $i++){
			$url = "{$url_info[1]}_{$i}_saleWeek_1.htm";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			//if(preg_match_all('|<div class="ebookLst_s">.*<a name="link_prd_img" href="([^\"]*)".*<img src="[^\"]".*</a>.*<h2></span>(.*)</a></h2>.*<span>当当价：.*<em>￥([0-9]*)</em>.*<span>定价：<del>￥([0-9]*)</del></span>.*</div>|isU', $content, $product_info)){
			if(preg_match_all('|<div class="ebookLst_s">.*<a name="link_prd_img" href="([^"]*)".*<img src="([^"]*)".*<h2>.*</span>(.*)</a></h2>.*<span>当当价：.*<em>￥(.*)</em>.*<span>定价：<del>￥(.*)</del></span>.*</div>|isU', $content, $product_info)){
				print_r($product_info);
			}else{
				echo "preg fail.\n";
			}
		}


}

if( preg_match('|http://category\.dangdang\.com/all/\?category_path=*|', $url) ){
	if(preg_match('|<span>共([0-9]*)页 到第</span>|isU', $content, $page_info)){
		$max_page = intval($page_info[1]);
	}
	//print_r($url);
	//print_r($page_info);

		for($i=1; $i<=1; $i++){
			$url = "{$url}&page_index={$i}";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			if(preg_match('|<div class="inner">.*<img src=\'([^\']*)\'.*<p class="name".*<a.*href="([^\"]*)".*>(.*)</a></p>.*<span class="price_n">&yen;(.*)</span><span class="price_r">&yen;(.*)</span>.*</div>|isU', $content, $product_info)){
				print_r($product_info);
			}else{
				echo "preg fail\n";
			}
		}

}

if( preg_match('|(http://category\.dangdang\.com/cid.*)\.html|', $url, $url_info) ){
	//获取最大链接
	if(preg_match('|<span>共([0-9]*)页 到第</span>|isU', $content, $page_info)){
		$max_page = intval($page_info[1]);
	}
	//print_r($url_info);
	//print_r($page_info);

		for($i=1; $i<=1; $i++){
			$url = "{$url_info[1]}-pg{$i}.html";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			if(preg_match('|<div class="inner">.*<img data-original=\'([^\']*)\'.*<span class="price_n">&yen;(.*)</span><span class="price_r">&yen;(.*)</span>.*<p class="name".*<a.*href="([^\"]*)".*>(.*)</a></p>.*class="subtitle".*>(.*)</p>.*</div>|isU', $content, $product_info)){
				print_r($product_info);
			}else{
				echo "preg fail\n";
			}
		}
}
?>
