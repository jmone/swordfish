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
$entry = 'http://www.1mall.com/marketing/allproduct.html';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);
//print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($url = array_pop($category_urls)){
	$content = callback($url);
	echo $url,"\n";

	//解析分页列表链接格式
	if( !preg_match("|<a orderbyId=\"2\" .* url='([^\']*)'><span>销量</span></a>|isU", $content, $url_info) ){
		continue;
	}
	if( !preg_match('|<span class="pageOp">共([0-9]*)页</span>|isU', $content, $page_info) ){
		continue;
	}
	$max_page = intval($page_info[1]);
	
	for($i=1; $i<=$max_page; $i++){
		$url = str_replace('p1', 'p'.$i, $url_info[1]);
		$content = callback($url);
		$data = json_decode($content, true);
		parse_info($data["value"]);

		$url .= "?isGetMoreProducts=1&moreProductsDefaultTemplate=0";
		$content = callback($url);
		$data = json_decode($content, true);
		parse_info($data["value"]);
	}
}

//function list
function parse_info($content){
	$preg_rules = array(
		1 => '|<li class="producteg" id="producteg_.*">.*<strong id="price.*" productId=".*">(.*)</strong>.*<del id="listprice.*">(.*)</del>.*<img .*="([^\"]*)".*/>.*<a class="title" id="pdlink.*" pmId=".*" href="([^\"]*)".*>(.*)</a>.*</li>|isU',
		2 => '|<li class="producteg" id="producteg_.*">.*<img .*="([^\"]*)".*/>.*<a class="title" id="pdlink.*" pmId=".*" href="([^\"]*)".*>(.*)</a>.*<strong id="price.*" productId=".*">(.*)</strong>.*<del id="listprice.*">(.*)</del>.*</li>|isU',
	);
	foreach($preg_rules as $ruleid => $rule){
		if(preg_match_all($rule, $content, $product_info)){
			foreach($product_info[0] as $p_index => $p){
				if($ruleid == 1){
					$url = trim($product_info[4][$p_index]);
					if(strpos($url, '?')){
						$url = substr($url, 0, strpos($url, '?'));
					}
					$product = array(
						'shop_id' => 4,
						'title' => trim($product_info[5][$p_index]),
						'sale_price' => str_replace('¥', '', trim($product_info[1][$p_index])),
						'original_price' => str_replace('¥', '', trim($product_info[2][$p_index])),
						'url' => $url,
						'update_time' => time(),
						'image' => trim($product_info[3][$p_index]),
						'reindex' => true,
					);
				}elseif($ruleid == 2){
					$url = trim($product_info[2][$p_index]);
					if(strpos($url, '?')){
						$url = substr($url, 0, strpos($url, '?'));
					}
					$product = array(
						'shop_id' => 4,
						'title' => trim($product_info[3][$p_index]),
						'sale_price' => str_replace('¥', '', trim($product_info[4][$p_index])),
						'original_price' => str_replace('¥', '', trim($product_info[5][$p_index])),
						'url' => $url,
						'update_time' => time(),
						'image' => trim($product_info[1][$p_index]),
						'reindex' => true,
					);

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

function category_urls($content){
	$urls = parse_links($content);
	foreach($urls as $index => $url){
		if(stripos($url, '1mall.com') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://www.1mall.com/ctg/s2/*|', $url)
		){
			unset($urls[$index]);
			continue;
		}
		if(strpos($url, '?')){
			$url = substr($url, 0, strpos($url, '?'));
		}
		if(strpos($url, "/1/") === false){
			$url = $url.'1/';
		}
		$urls[$index] = $url;
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
