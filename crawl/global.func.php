<?php
function callback($url, $params = array(), $isreturn = true){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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

?>
