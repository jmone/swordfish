<?php
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'global.func.php';

$crawled_urls = array();
$uncrawled_urls = array();
$entry = 'http://book.dangdang.com/';

init();
if(empty($uncrawled_urls)){
    die('empty uncrawled url queue.');
}

while ($url = array_pop($uncrawled_urls)){
    if(APP_DEBUY){
        echo "crawl:$url\n";
    }
	$content = callback($url);
	$content = iconv('GBK', 'UTF-8', $content);
    //解析页面，如果是产品页，提取入库
    
    //解析之后，链接入已处理列表
    array_push($crawled_urls, $url);
    //解析出页面新链接，循环处理之
    $links = parse_links($content);
    foreach ($links as $link){
        if(!in_array($link, $crawled_urls) && !in_array($link, $uncrawled_urls)){
            array_push($uncrawled_urls, $link);
            if(APP_DEBUY){
                echo "push \$uncrawled_urls: $link\n";
            }
        }
    }
}

//function list
function init(){
    global $crawled_urls, $uncrawled_urls, $entry;
    array_push($uncrawled_urls, $entry);
}
?>
