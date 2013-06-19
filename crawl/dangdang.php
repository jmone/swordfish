<?php
/**
 * 
 * jiangming <admin@exephp.com>
 */
define('APP_DEBUY', TRUE);

define('APP_ROOT', dirname(__FILE__).'/');
include APP_ROOT.'global.func.php';

$crawled_urls = array();
$uncrawled_urls = array();
$entry = 'http://book.dangdang.com/';
$entry = 'http://product.dangdang.com/product.aspx?product_id=1076302202';

init();
$conn = new Mongo;
$db = $conn->swordfish;
$collection = $db->product;
if(empty($uncrawled_urls)){
    die('empty uncrawled url queue.');
}

while ($url = array_pop($uncrawled_urls)){
    if(APP_DEBUY){
        echo "crawl:$url\n";
    }
	$content = callback($url);
	echo $content = iconv('GBK', 'UTF-8', $content);
    //解析页面，如果是产品页，提取入库
    parse_info($url, $content);
    die;
    
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
function parse_info($url, $content){
    global $collection;
    if(preg_match('|<h1>(.*)<span.*></span></h1>.*<p>.*<b.*><span class="yen">&yen;</span>(.*)</b><span class="break"></span></p>.*<i class="m_price">&yen;(.*)</i>|isU', $content, $value)){
		print_r($value);
        if(preg_match('|<img id="largePic".*src="([^\"]*)".*>|', $content, $pic)){
            $image = $pic[1];
        }else{
            $image = '';
        }
		$product = array(
			'title' => $value[1],
			'sale_price' => $value[2],
			'original_price' => $value[3],
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
?>
