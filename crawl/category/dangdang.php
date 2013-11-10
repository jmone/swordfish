<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(dirname(__FILE__)).'/');
include APP_ROOT.'init.inc.php';

$site_id = 1;
$entry = 'http://category.dangdang.com/';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$content = iconv('GBK', 'UTF-8', $content);
$category_urls = category_urls($content);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($item = array_pop($category_urls)){

	$url = $item['url'];
	if( preg_match('|(http://category\.dangdang\.com/cid.*)\.html|', $url, $url_info) ){
		if(preg_match('|cid(.*)\.html|', $url, $cid)){
			$category_id = $cid[1];
		}
	}elseif( preg_match('|http://category\.dangdang\.com/all/\?category_path=*|', $url) ){
		if(preg_match('|category_path=(.*)|', $url, $cid)){
			$category_id = $cid[1];
		}
	}elseif( preg_match('|(http://e\.dangdang\.com/list_.*)\.htm|', $url, $url_info) ){
		if(preg_match('|list_(.*)\.htm|', $url, $cid)){
			$category_id = $cid[1];
		}
	}else{
		continue;
	}
	//echo "$url\n";
	insert_category($site_id, $category_id, $item['url'], $item['name']);
}

function category_urls($content){
	$urls = linksName($content);
	foreach($urls as $index => $item){
		$url = $item['url'];
		if(stripos($url, 'dangdang.com') === false){
			unset($urls[$index]);
			continue;
		}
		if( !preg_match('|http://category.dangdang.com/all/\?category_path=*|', $url)
		 && !preg_match('|http://e.dangdang.com/list_*|', $url)
		 && !preg_match('|http://category.dangdang.com/cid*|', $url)
		){
			unset($urls[$index]);
			continue;
		}
		if(strpos($url, "#")){
			$url = substr($url, 0, strpos($url, "#"));
			$item['url'] = $url;
			$urls[$index] = $item;
		}
	}
	return $urls;
}
?>
