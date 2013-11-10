<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(dirname(__FILE__)).'/');
include APP_ROOT.'init.inc.php';

$site_id = 4;
$entry = 'http://www.1mall.com/marketing/allproduct.html';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);
//print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($item = array_pop($category_urls)){
	if( preg_match("|ctg/s2/c(.*)-|isU", $item['url'], $url_info) ){
		$category_id = $url_info[1];
		insert_category($site_id, $category_id, $item['url'], $item['name']);
	}
}

function category_urls($content){
	//$urls = parse_links($content);
	$urls = linksName($content);
	foreach($urls as $index => $item){
		$url = $item['url'];
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
		$item['url'] = $url;
		$urls[$index] = $item;
	}
	return $urls;
}
?>
