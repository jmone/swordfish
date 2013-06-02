<?php
include "global.func.php";
$conn = new Mongo;
$db = $conn->swordfish;
$collection = $db->product;
for($i=20163242; $i<20163253; $i++){
	$url = "http://product.dangdang.com/product.aspx?product_id={$i}";
	$content = callback($url);
	$content = iconv('GBK', 'UTF-8', $content);
	if(preg_match('|<h1>(.*)<span.*></span></h1>.*<p>.*<b.*><span class="yen">&yen;</span>(.*)</b><span class="break"></span></p>.*<i class="m_price">&yen;(.*)</i>|isU', $content, $value)){
		//print_r($value);
		$product = array(
			'title' => $value[1],
			'sale_price' => $value[2],
			'original_price' => $value[3],
			'url' => $url,
			'update_time' => time(),
			'reindex' => true,
		);
		$temp = $collection->findOne(array(
			'url' => $url,
		));
		//print_r($temp);
		if(empty($temp)){
			$collection->insert($product);
		}else{
			if($product['title'] == $temp['title']){
				$product['reindex'] = false;
			}
			if($product['title'] != $temp['title'] || $product['sale_price'] !=  $temp['sale_price']){
				$collection->update(array('url'=>$url), $product);
			}else{
				echo 'Product not modified.';
			}
		}
	}
}
?>
