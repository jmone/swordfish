<?php
define('APP_DEBUY', TRUE);
define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'init.inc.php';

//获取库中要抓取的url总数
//分页获取库中的url

for($i=1; $i<=1000000; $i++){
	$url = "http://item.jd.com/{$i}.html";
	$content = file_get_contents($url);
	$content = iconv('GBK', 'UTF-8', $content);
	//解析页面，如果是产品页，提取入库
	parse_info($i, $url, $content);
}

//function list
function init(){
	global $crawled_urls, $uncrawled_urls, $entry;
	array_push($uncrawled_urls, $entry);
}
function parse_info($id, $url, $content){
	global $collection;
	if(preg_match('|<h1>(.*)</h1>|isU', $content, $title)){
		//print_r($title);

		//取商品图片 start
		if(preg_match('|<img data-img="1" width="350" height="350" src="([^\"]*)".*jqimg.*/>|isU', $content, $pic)){
			$image = $pic[1];
		}else{
			$image = '';
		}
		//取商品图片 end

		//取商品价格 start
		$price = get_price($id);
		//取商品价格 end

		$product = array(
			'shop_id' => 3,
			'item_id' => $id,
			'title' => trim($title[1]),
			'sale_price' => str_replace(',', '', $price[1]),
			'original_price' => str_replace(',', '', $price[2]),
			'url' => $url,
			'update_time' => time(),
			'image' => $image,
			'reindex' => true,
		);
		print_r($product);
		//die;
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
	}else{
		echo "Url not exists: ".$url ."\n";
	}
}

function get_price($id){
	$url = "http://jprice.jd.com/price/np{$id}-TRANSACTION-J.html";

	//为防止被禁，暂时不开启本过程
	$content = file_get_contents($url);
	if(preg_match('|getNumPriceService\((.*)\);|', $content, $jsonPrice)){
		//print_r($jsonPrice);
		$prices = json_decode($jsonPrice[1], true);
		//print_r($prices);
		if(isset($prices["jdPrice"]) && isset($prices["salesPrice"])){
			return array(
				1 => $prices["jdPrice"]["amount"],
				2 => $prices["salesPrice"]["amount"],
			);
		}
	}
	return false;
}
?>
