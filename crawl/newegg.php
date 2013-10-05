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
$entry = 'http://www.newegg.com.cn/CategoryList.htm';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);
//print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($url = array_pop($category_urls)){
	$content = file_get_contents($url);
	$content = iconv('GBK', 'UTF-8', $content);
	echo $url,"\n";

	if( !preg_match('|<ins>[0-9]*/([0-9]*)</ins>|isU', $content, $page_info) ){
		continue;
	}
	$max_page = intval($page_info[1]);
	
	for($i=1; $i<=$max_page; $i++){
		$url_i = substr($url, 0, strrpos($url, '.'))."-{$i}.htm";
		echo $url_i, "\n";
		$content = file_get_contents($url_i);
		$content = iconv('GBK', 'UTF-8', $content);
		parse_info($content);
	}
}

//function list
function parse_info($content){
	$preg_rules = array(
		//1 => '|<li class="cls">.*<div class="img">.*<img src="([^\"]*)" alt.*</div>.*<p class="title">.*<a href="([^\"]*)".*>(.*)</a>.*</p>.*<p class="prom">(.*)</p>.*<p class="priceline">.*<del>&yen;(.*)</del>.*<span class="price">&yen;(.*)</span>.*</p>.*</li>|isU',
		1 => '|<li class="cls">.*<div class="img">.*<img src="([^\"]*)" alt.*</div>.*<p class="title">.*<a href="([^\"]*)".*>(.*)</a>.*</p>.*<p class="prom">(.*)</p>.*<p class="priceline">.*<span class="price">&yen;(.*)</span>.*</p>.*</li>|isU',
		//1 => '|<li class="cls">.*<p class="priceline">.*<del>&yen;(.*)</del>.*<span class="price">&yen;(.*)</span>.*</p>.*</li>|isU',
	);
	foreach($preg_rules as $ruleid => $rule){
		if(preg_match_all($rule, $content, $product_info)){
			//print_r($product_info);
			foreach($product_info[0] as $p_index => $p){
				if($ruleid == 1){
					$url = trim($product_info[2][$p_index]);
					$product = array(
						'shop_id' => 5,
						'title' => trim($product_info[3][$p_index]),
						'alt' => trim($product_info[4][$p_index]),
						'sale_price' => trim($product_info[5][$p_index]),
						'original_price' => '',
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
	$content = iconv('GBK', 'UTF-8', $content);
	foreach($urls as $index => $url){
		if(stripos($url, 'newegg.com.cn') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://www.newegg.com.cn/SubCategory/[0-9]*.htm|', $url)
		){
			unset($urls[$index]);
			continue;
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
