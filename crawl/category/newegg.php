<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(dirname(__FILE__)).'/');
include APP_ROOT.'init.inc.php';

$site_id = 5;
$entry = 'http://www.newegg.com.cn/CategoryList.htm';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);
//print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($item = array_pop($category_urls)){
	$url = $item['url'];
	if(preg_match('|SubCategory/(.*)\.htm|', $url, $cid)){
		$category_id = $cid[1];
		insert_category($site_id, $category_id, $item['url'], $item['name']);
	}
}


function category_urls($content){
	$urls = linksName($content);
	$content = iconv('GBK', 'UTF-8', $content);
	foreach($urls as $index => $item){
		$url = $item['url'];
		if(stripos($url, 'newegg.com.cn') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://www.newegg.com.cn/SubCategory/[0-9]*.htm|', $url)
		){
			unset($urls[$index]);
			continue;
		}
		$item['url'] = $url;
		$urls[$index] = $item;
	}
	return $urls;
}

?>
