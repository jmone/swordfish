<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(dirname(__FILE__)).'/');
include APP_ROOT.'init.inc.php';

$site_id = 7;
$entry = 'http://st.icson.com/static_v1/js/app/categories_6.js?v=2013080301';

//解析分类入口页面，获取所有列表页面链接
$content = file_get_contents($entry);
$content = iconv('GBK', 'UTF-8', $content);
$category_urls = category_urls($content);
print_r($category_urls);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($item = array_pop($category_urls)){
	if(preg_match('|path=(.*)|', $item['url'], $cid)){
		$category_id = $cid[1];
		insert_category($site_id, $category_id, $item['url'], $item['name']);
	}
}
echo "Crawl over";

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
				array_push($urls, array('url'=>$url, 'name'=>$c['text']));
			}
		}
		//keyword
		foreach($d['keyword'] as $c){
			if($url = get_category_url($c['url'])){
				array_push($urls, array('url'=>$url, 'name'=>$c['text']));
			}
		}
		//list
		foreach($d['list'] as $list){
			foreach($list['list'] as $c){
				if($url = get_category_url($c['url'])){
					array_push($urls, array('url'=>$url, 'name'=>$c['text']));
				}
			}
		}
	}
	return $urls;
}

?>
