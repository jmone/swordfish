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
    if(preg_match_all('|<a href="([^\"]*)"|isU', $content, $matches)){
        foreach ($matches[1] as $link){
            if(substr($link, 0, 4) == 'http'){
                array_push($links, $link);
            }
        }
    }
    if(preg_match_all('|<a href=\'([^\']*)\'|isU', $content, $matches)){
        foreach ($matches[1] as $link){
            if(substr($link, 0, 4) == 'http'){
                array_push($links, $link);
            }
        }
    }
    return $links;
}
?>
