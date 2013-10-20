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
$entry = 'http://www.suning.com/emall/pgv_10052_10051_1_.html';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($url = array_pop($category_urls)){
	$url = str_replace('{cityId}', '9017', $url);
	$content = file_get_contents($url);

	//获取最大链接
	if(preg_match('|<i id="pageTotal">(.*)</i>|isU', $content, $page_info)){
		$max_page = intval($page_info[1]);
	}
	//print_r($url_info);
	//print_r($page_info);
	$url_rule = 'http://search.suning.com/emall/showProductList.do?ci={ci}&cityId=9017&pg=03&cp={cp}&il=0&si=5&st=14&iy=0&n=1';
	//解析出$url中的ci参数
	parse_str(parse_url($url,  PHP_URL_QUERY), $get);
	$url_rule = str_replace('ci={ci}', 'ci='.$get['ci'], $url_rule);

	for($i=0; $i<$max_page; $i++){
		$url = str_replace('cp={cp}', 'cp='.$i, $url_rule);
		echo $url, "\n";
		$content = file_get_contents($url);
		//var_dump($content);

		if(preg_match_all('|<li class=".*">.*<img class="err-product" src[2]*="([^\"]*)".*<a href="([^\"]*)".*<p>(.*)<em></em></p></a>.*</li>|isU', $content, $product_info)){
			//print_r($product_info);
			foreach($product_info[2] as $index => $p_url){
				$p_content = file_get_contents($p_url);
				if(preg_match('|&currPrice=(.*)&|isU', $p_content, $p)){
					print_r($p);
				}else{
					continue;
				}
				$product = array(
						'shop_id' => 6,
						'category_id' => $get['ci'],
						'title' => trim($product_info[3][$index]),
						'alt' => '',
						'sale_price' => doubleval(trim($p[1])),
						'original_price' => 0,
						'url' => trim($product_info[2][$index]),
						'update_time' => time(),
						'image' => trim($product_info[1][$index]),
						'reindex' => true,
						);
				if(strpos($product['url'], '#') !== false){
					$product['url'] = substr($product['url'], 0, strpos($product['url'], '#'));
				}
				//insert_mongo($product);
				insert_mysql($product);
			}
		}else{
			echo "preg fail\n";
		}
	}
}

function category_urls($content){
	$urls = parse_links($content);
	foreach($urls as $index => $url){
		if(stripos($url, 'suning.com') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://search.suning.com/emall/strd.do\?ci=*|', $url)
		  ){
			//print_r($url);echo "\n";
			unset($urls[$index]);
			continue;
		}
		if(strpos($url, "#")){
			$urls[$index] = substr($url, 0, strpos($url, "#"));
		}
	}
	return $urls;
}

/*
   while ($url = array_pop($uncrawled_urls)){
   if(APP_DEBUY){
   echo "crawl:$url\n";
   }
   $content = callback($url);
   $content = iconv('GBK', 'UTF-8', $content);
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
if(stripos($link, 'suning.com') === false || stripos($link, 'comment') !== false){
continue;
}
array_push($uncrawled_urls, $link);
if(APP_DEBUY){
echo "push \$uncrawled_urls: $link\n";
}
}
}
}
 */

//function list
function init(){
	while(true){
		sleep(10000);
	}
	global $crawled_urls, $uncrawled_urls, $entry;
	array_push($uncrawled_urls, $entry);
}
function parse_info($url, $content){
	global $collection;
	if(preg_match('|<h1>(.*)<span.*></span></h1>|isU', $content, $title)){
		print_r($title);
		//取商品价格 start
		$pattern = array(
				'|<p>.*<b id="d_price".*><span class="yen"></span><span id="salePriceTag">&yen;(.*)</span></b></p>.*<i class="m_price" id="originalPriceTag">&yen;&nbsp;(.*)</i>|isU',
				'|<p>.*<b id="d_price".*><span class="yen"></span><span id="salePriceTag">¥(.*)</span></b></p>.*<i class="m_price" id="originalPriceTag">¥&nbsp;(.*)</i>|isU',
				'|<p>.*<b.*><span class="yen">&yen;</span>(.*)</b><span class="break"></span></p>.*<i class="m_price">&yen;(.*)</i>|isU',
				'|<i.*id="promo_price">&yen;(.*)</i>.*<i class="m_price" id="originalPriceTag">&yen;&nbsp;(.*)</i>|isU',
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
		if(preg_match('|<img id="largePic".*src="([^\"]*)".*>|', $content, $pic)){
			$image = $pic[1];
		}else{
			$image = '';
		}
		//取商品图片 end

		$product = array(
				'shop_id' => 1,
				'title' => $title[1],
				'sale_price' => $price[1],
				'original_price' => $price[2],
				'url' => $url,
				'update_time' => time(),
				'image' => $image,
				'reindex' => true,
				);
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
		if($product['title'] != $temp['title'] || $product['alt'] != $temp['alt'] || $product['original_price'] != $temp['original_price'] || $product['sale_price'] !=  $temp['sale_price']){
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
