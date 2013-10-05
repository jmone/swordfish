<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'init.inc.php';

$crawled_urls = array();
$uncrawled_urls = array();
$entry = 'http://st.icson.com/static_v1/js/app/categories_6.js?v=2013080301';

//解析分类入口页面，获取所有列表页面链接
$content = file_get_contents($entry);
$content = iconv('GBK', 'UTF-8', $content);
$category_urls = category_urls($content);
//print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($url = array_pop($category_urls)){
	$content = file_get_contents($url);
	echo $url,"\n";

	if( !preg_match('|相关产品<b>([0-9]*)</b>件|isU', $content, $total_item_num) ){
		continue;
	}
	$max_page = ceil($total_item_num[1]/32);
	
	for($i=1; $i<=$max_page; $i++){
		$url_i = $url.'&page='.$i;
		echo $url_i, "\n";
		$content = file_get_contents($url_i);
		parse_info($content);
	}
}
echo "Crawl over";

//function list
function parse_info($content){
	$preg_rules = array(
		1 => '|<li class="item_list".*>.*<a class="link_pic" target="_blank" href="(.*)".*><img width="200" init_src="(.*)" title="(.*)".*></a>.*<p class="price_icson">价格：<strong class="hot">&yen(.*)</strong></p>.*</li>|isU',
	);
	foreach($preg_rules as $ruleid => $rule){
		if(preg_match_all($rule, $content, $product_info)){
			//print_r($product_info);
			foreach($product_info[0] as $p_index => $p){
				if($ruleid == 1){
					$url = trim($product_info[1][$p_index]);
					$product = array(
						'shop_id' => 7,
						'title' => trim($product_info[3][$p_index]),
						'alt' => '',
						'sale_price' => trim($product_info[4][$p_index]),
						'original_price' => '',
						'url' => $url,
						'update_time' => time(),
						'image' => trim($product_info[2][$p_index]),
						'reindex' => true,
					);
				}
				if(strpos($product['url'], '?') !== false){
					$product['url'] = substr($product['url'], 0, strpos($product['url'], '?'));
				}
				if(strpos($product['url'], '#') !== false){
					$product['url'] = substr($product['url'], 0, strpos($product['url'], '#'));
				}
				//insert_mongo($product);
				insert_mysql($product);
			}
			break;
		}
	}
}

function get_category_url($url){
	$url = strtolower($url).'&';
	if(strpos($url, "searchex.yixun.com") === false){
		return false;
	}
	$url = preg_replace('|attr=[^&]*&|', '', $url);
	$url = preg_replace('|ytag=[^&]*&|', '', $url);
	$url = preg_replace('|area=[^&]*&|', '', $url);
	$url = preg_replace('|key=[^&]*&|', '', $url);
	$url = preg_replace('|as=[^&]*&|', '', $url);
	$url = str_replace('&', '', $url);
	if(preg_match("|http://searchex\.yixun\.com/html\?path=[0-9\|t]*|", $url)){
		return $url;
	}else{
		return false;
	}
}
function category_urls($content){
	$urls = array();
	$content = str_replace("window.CATEGORY_CONFIG=", "", $content);
	$data = json_decode($content, true);
	foreach($data as $d){
		//c1list
		foreach($d['c1list'] as $c){
			if($url = get_category_url($c['url'])){
				array_push($urls, $url);
			}
		}
		//keyword
		foreach($d['keyword'] as $c){
			if($url = get_category_url($c['url'])){
				array_push($urls, $url);
			}
		}
		//list
		foreach($d['list'] as $list){
			foreach($list['list'] as $c){
				if($url = get_category_url($c['url'])){
					array_push($urls, $url);
				}
			}
		}
	}
	return $urls;
}

function init(){
	global $crawled_urls, $uncrawled_urls, $entry;
	array_push($uncrawled_urls, $entry);
}

function insert_mongo($product){
	global $collection;
	$url = $product['url'];
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
		if($product['title'] != $temp['title'] || $product['original_price'] != $temp['original_price'] || $product['sale_price'] !=  $temp['sale_price']){
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
?>
