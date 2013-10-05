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
$entry = 'http://category.dangdang.com/';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$content = iconv('GBK', 'UTF-8', $content);
$category_urls = category_urls($content);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($url = array_pop($category_urls)){
	$content = callback($url);
	$content = iconv('GBK', 'UTF-8', $content);

	if( preg_match('|(http://category\.dangdang\.com/cid.*)\.html|', $url, $url_info) ){
		//获取最大链接
		if(preg_match('|<span>共([0-9]*)页 到第</span>|isU', $content, $page_info)){
			$max_page = intval($page_info[1]);
		}
		//print_r($url_info);
		//print_r($page_info);
		for($i=1; $i<=$max_page; $i++){
			$url = "{$url_info[1]}-pg{$i}.html";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			if(preg_match_all('|<div class="inner">.*<img data-original=\'([^\']*)\'.*<span class="price_n">&yen;(.*)</span><span class="price_r">&yen;(.*)</span>.*<p class="name".*<a.*href="([^\"]*)".*>(.*)</a></p>.*class="subtitle".*>(.*)</p>.*</div>|isU', $content, $product_info)){
				//print_r($product_info);
				foreach($product_info[0] as $p_index => $p){
					$product = array(
						'shop_id' => 1,
						'title' => trim($product_info[5][$p_index]),
						'alt' => trim($product_info[6][$p_index]),
						'sale_price' => trim($product_info[2][$p_index]),
						'original_price' => trim($product_info[3][$p_index]),
						'url' => trim($product_info[4][$p_index]),
						'update_time' => time(),
						'image' => trim($product_info[1][$p_index]),
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
	}elseif( preg_match('|http://category\.dangdang\.com/all/\?category_path=*|', $url) ){
		if(preg_match('|<span>共([0-9]*)页 到第</span>|isU', $content, $page_info)){
			$max_page = intval($page_info[1]);
		}
		//print_r($url);
		//print_r($page_info);

		for($i=1; $i<=$max_page; $i++){
			$url = "{$url}&page_index={$i}";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			if(preg_match_all('|<div class="inner">.*<img src=\'([^\']*)\'.*<p class="name".*<a.*href="([^\"]*)".*>(.*)</a></p>.*<span class="price_n">&yen;(.*)</span><span class="price_r">&yen;(.*)</span>.*</div>|isU', $content, $product_info)){
				print_r($product_info);
				foreach($product_info[0] as $p_index => $p){
					$product = array(
						'shop_id' => 1,
						'title' => trim($product_info[3][$p_index]),
						'sale_price' => trim($product_info[4][$p_index]),
						'original_price' => trim($product_info[5][$p_index]),
						'url' => trim($product_info[2][$p_index]),
						'update_time' => time(),
						'image' => trim($product_info[1][$p_index]),
						'reindex' => true,
					);
					if(strpos($product['url'], '#') !== false){
						$product['url'] = substr($product['url'], 0, strpos($product['url'], '#'));
					}
					insert_mongo($product);
				}
			}else{
				echo "preg fail\n";
			}
		}

	}elseif( preg_match('|(http://e\.dangdang\.com/list_.*)\.htm|', $url, $url_info) ){

		if(preg_match('|<input type="hidden" name="totalPage" value="([0-9]*)"/>|isU', $content, $page_info)){
			$max_page = intval($page_info[1]);
		}
		//print_r($url_info);
		//print_r($page_info);
	
		for($i=1; $i<=$max_page; $i++){
			$url = "{$url_info[1]}_{$i}_saleWeek_1.htm";
			echo $url, "\n";
			$content = callback($url);
			$content = iconv('GBK', 'UTF-8', $content);

			if(preg_match_all('|<div class="ebookLst_s">.*<a name="link_prd_img" href="([^"]*)".*<img src="([^"]*)".*<h2>.*</span>(.*)</a></h2>.*<span>当当价：.*<em>￥(.*)</em>.*<span>定价：<del>￥(.*)</del></span>.*</div>|isU', $content, $product_info)){
				//print_r($product_info);
				foreach($product_info[0] as $p_index => $p){
					$product = array(
						'shop_id' => 1,
						'title' => trim($product_info[3][$p_index]),
						'sale_price' => trim($product_info[4][$p_index]),
						'original_price' => trim($product_info[5][$p_index]),
						'url' => trim($product_info[1][$p_index]),
						'update_time' => time(),
						'image' => trim($product_info[2][$p_index]),
						'reindex' => true,
					);
					if(strpos($product['url'], '#') !== false){
						$product['url'] = substr($product['url'], 0, strpos($product['url'], '#'));
					}
					insert_mongo($product);
				}
			}else{
				echo "preg fail.\n";
			}
		}

	}

}

function category_urls($content){
	$urls = parse_links($content);
	foreach($urls as $index => $url){
		if(stripos($url, 'dangdang.com') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://category.dangdang.com/all/\?category_path=*|', $url)
		 && !preg_match('|http://e.dangdang.com/list_*|', $url)
		 && !preg_match('|http://category.dangdang.com/cid*|', $url)
		){
			print_r($url);echo "\n";
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
			if(stripos($link, 'dangdang.com') === false || stripos($link, 'comment') !== false){
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
