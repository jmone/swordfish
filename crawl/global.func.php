<?php
function callback($url, $params = array(), $isreturn = true){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	$rst = curl_exec($ch);
	curl_close($ch);
	if($isreturn){
		return $rst;
	}
}
function get_safe_string($str){
	$str = trim($str);
	//$str = htmlentities($str);
	$str = addslashes($str);
	return $str;
}
function url_exists($url){
	global $link_id;
	$sql = "SELECT count(*) FROM article WHERE url='{$url}';";
	$result = mysql_query($sql, $link_id);
	$count = mysql_result($result, 0);
	return $count;
}
function parse_links($content = ''){
    $links = array();
    if(empty($content)){
        return $links;
    }
    if(preg_match_all('|<a.*href="([^\"]*)"|isU', $content, $matches)){
        foreach ($matches[1] as $link){
            if(substr($link, 0, 4) == 'http'){
                array_push($links, $link);
            }
        }
    }
    if(preg_match_all('|<a.*href=\'([^\']*)\'|isU', $content, $matches)){
        foreach ($matches[1] as $link){
            if(substr($link, 0, 4) == 'http'){
                array_push($links, $link);
            }
        }
    }
    return $links;
}

function insert_mysql($product){
	global $link;
	$url = $product['url'];
	$sql = "SELECT * FROM product WHERE url='$url';";
	$result = mysql_query($sql, $link);
	$temp = mysql_fetch_array($result, MYSQL_ASSOC);

	if(empty($temp)){
		$sql = "INSERT INTO product (shop_id, category_id, title, sale_price, original_price, url, update_time, image, reindex) VALUES ('{$product['shop_id']}', '{$product['category_id']}', '{$product['title']}', '{$product['sale_price']}', '{$product['original_price']}', '{$product['url']}', '{$product['update_time']}', '{$product['image']}', '{$product['reindex']}')";
		if( mysql_query($sql, $link) ){
			echo "insert successful: $url\n";
		}else{
			echo "insert fail: $url\n";
		}
	}else{
		if($product['title'] == $temp['title']){
			$product['reindex'] = false;
		}
		if($product['title'] != $temp['title'] || $product['alt'] != $temp['alt'] || $product['original_price'] != $temp['original_price'] || $product['sale_price'] !=  $temp['sale_price']){
			$sql = "UPDATE product SET shop_id='{$product['shop_id']}', category_id='{$product['category_id']}' title='{$product['title']}', sale_price='{$product['sale_price']}', original_price='{$product['original_price']}', url='{$product['url']}', update_time='{$product['update_time']}', image='{$product['image']}', reindex='{$product['reindex']}' WHERE id='{$temp['id']}';";
			mysql_query($sql, $link);
			if(APP_DEBUY){
				echo "update: $url\n";
			}
		}else{
			if(APP_DEBUY){
				echo "Product not modified, url:$url\n";
			}
		}

	}
}

function insert_category($site_id, $category_id, $url, $name){
	global $link;
	$sql = "SELECT * FROM category_mapping WHERE site_id='$site_id' AND site_category_id='$category_id';";
	$result = mysql_query($sql, $link);
	$temp = mysql_fetch_array($result, MYSQL_ASSOC);

	if(empty($temp)){
		$sql = "INSERT INTO category_mapping (site_id, site_category_id, site_url, name) VALUES ('{$site_id}', '{$category_id}', '{$url}', '{$name}')";
		if( mysql_query($sql, $link) ){
			echo "insert successful: $url\n";
		}else{
			echo "insert fail: $url\n";
		}
	}else{
		if($temp['site_url'] != $url || $temp['name'] != $name){
			$sql = "UPDATE category_mapping SET site_url='{$url}', name='{$name}' WHERE site_id='$site_id' AND site_category_id='$category_id'";
			mysql_query($sql, $link);
			if(APP_DEBUY){
				echo "update: $url\n";
			}
		}else{
			if(APP_DEBUY){
				echo "Product not modified, url:$url\n";
			}
		}

	}
}

function linksName($content = ''){
	$links = array();
	if(empty($content)){
		return $links;
	}
	$i = 0;
	if(preg_match_all('|<a.*href="([^\"]*)".*>(.*)<|isU', $content, $matches)){
		foreach ($matches[1] as $id => $link){
		    if(substr($link, 0, 4) == 'http'){
			$links[$i++] = array(
				'url' => $link,
				'name' => $matches[2][$id],
			);
		    }
		}
		//print_r($matches);
	}
	if(preg_match_all('|<a.*href=\'([^\']*)\'.*>(.*)<|isU', $content, $matches)){
		foreach ($matches[1] as $id => $link){
		    if(substr($link, 0, 4) == 'http'){
			$links[$i++] = array(
				'url' => $link,
				'name' => $matches[2][$id],
			);
		    }
		}
	}
	return $links;
}
?>
