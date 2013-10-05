<?php
/**
 * 
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'init.inc.php';

$crawled_urls = array();
$uncrawled_urls = array();
$entry = 'http://www.amazon.cn/';

if(empty($uncrawled_urls)){
	die('empty uncrawled url queue.');
}

while ($url = array_pop($uncrawled_urls)){
	if(APP_DEBUY){
		echo "crawl:$url\n";
	}
	$content = callback($url);
	//$content = iconv('GBK', 'UTF-8', $content);
	//解析页面，如果是产品页，提取入库
	parse_info($url, $content);
	//die;
	$size_crawled = count($crawled_urls);
	$size_uncrawled = count($uncrawled_urls);
	echo "Size of \$uncrawled urls:$size_crawled; Size of \$crawled urls:$size_uncrawled\n";

	//解析之后，链接入已处理列表
	array_push($crawled_urls, $url);
	//解析出页面新链接，循环处理之
	$links = parse_links($content);
	foreach ($links as $link){
		if(!in_array($link, $crawled_urls) && !in_array($link, $uncrawled_urls)){
			if(stripos($link, 'amazon.cn') === false || stripos($link, 'signin') !== false || stripos($link, 'forum') !== false){
				continue;
			}
			array_push($uncrawled_urls, $link);
			if(APP_DEBUY){
				echo "push \$uncrawled_urls: $link\n";
			}
		}
	}
}

//function list
function init(){
	global $crawled_urls, $uncrawled_urls, $entry;
	array_push($uncrawled_urls, $entry);
}
function parse_info($url, $content){
	global $collection;
	if(preg_match('|<span id="btAsinTitle">(.*)</span>|isU', $content, $title)){
		print_r($title);
		//取商品价格 start
		$pattern = array(
			'|<span id="listPriceValue".*>￥ (.*)</span>.*<span id="actualPriceValue"><b class="priceLarge">￥ (.*)</b></span>|isU',
		);
		$price_tag = false;
		$price = array();
		foreach($pattern as $p){
			if(preg_match($p, $content, $temp_price)){
				$price = $temp_price;
				$price_tag = true;
				continue;
			}
		}
		if(!$price_tag){
			echo "$url\n";
			return ;
		}
		print_r($price);
		//取商品价格 end

		//取商品图片 start
		if(preg_match('|<div class="main-image-inner-wrapper">.*<img src="([^\"]*)".*id="original-main-image".*>.*</div>|isU', $content, $pic)){
			$image = $pic[1];
		}else{
			$image = '';
		}
		//取商品图片 end

		$product = array(
			'shop_id' => 2,
			'title' => trim($title[1]),
			'sale_price' => str_replace(',', '', $price[1]),
			'original_price' => str_replace(',', '', $price[2]),
			'url' => $url,
			'update_time' => time(),
			'image' => $image,
			'reindex' => true,
		);
		//print_r($product);
		$temp = $collection->findOne(array(
			'url' => $url,
		));
		//print_r($temp);
		if(empty($temp)){
			$collection->insert($product);
			if(APP_DEBUY){
				echo "insert: $url\n";
			}
		}else{
			if($product['title'] == $temp['title']){
				$product['reindex'] = false;
			}
			if($product['title'] != $temp['title'] || $product['sale_price'] !=  $temp['sale_price']){
				$collection->update(array('url'=>$url), $product);
				if(APP_DEBUY){
					echo "insert: $url\n";
				}
			}else{
				if(APP_DEBUY){
					echo "Product not modified, url:$url\n";
				}
			}
		}
	}
}
?>
