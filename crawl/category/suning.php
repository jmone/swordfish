<?php
/**
 * 从分类页面入手
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(dirname(__FILE__)).'/');
include APP_ROOT.'init.inc.php';

$site_id = 6;
$entry = 'http://www.suning.com/emall/pgv_10052_10051_1_.html';

//解析分类入口页面，获取所有列表页面链接
$content = callback($entry);
$category_urls = category_urls($content);

//根据列表页生成分页列表，解析每页的产品、分页链接
while($item = array_pop($category_urls)){
	$url = str_replace('{cityId}', '9017', $item['url']);

	//解析出$url中的ci参数
	parse_str(parse_url($url,  PHP_URL_QUERY), $get);
	if(isset($get['ci'])){
		$category_id = $get['ci'];
		insert_category($site_id, $category_id, $url, $item['name']);
	}
}

function category_urls($content){
	$urls = linksName($content);
	foreach($urls as $index => $item){
		$url = $item['url'];
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
			$url = substr($url, 0, strpos($url, "#"));
		}
		$item['url'] = $url;
		$urls[$index] = $item;
	}
	return $urls;
}

?>
