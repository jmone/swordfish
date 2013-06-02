<?php
set_time_limit(0);
//db
$link_id = mysql_pconnect('127.0.0.1', 'root', '32100321jm') or die('db connect fail.');
mysql_select_db('juzi_searcher', $link_id);
mysql_query('set charset utf8');

for($i=3; $i>0; $i++){
	$page_url = "http://blog.csdn.net/column.html?page={$i}";
	//$page_url = "http://blog.csdn.net/experts.html?page={$i}";
	//$page_url = "http://blog.csdn.net/hot.html?page={$i}";
	$page_content = callback($page_url);
	//解析出文章列表链接
	if(preg_match_all('|<div class="blog_list">.*</span>.*<a href="(.*)" target="_blank" class="view">阅读\([0-9]*\)</a>.*</div>|isU', $page_content, $links)){
		$links[1] = array_reverse($links[1]);
		//print_r($links);
		if(is_array($links[1]) && count($links[1])){
			foreach($links[1] as $link){
				if(url_exists($link)){
					echo $link, "  exists\n";
					continue;
				}
				echo $link, "\n";
				$content = callback($link);
				//解析出文章标题及正文
				if(preg_match('|<div class="article_title">.*<span class="link_title"><a href=".*">(.*)</a>.*</span>.*</div>.*<div id="article_content" class="article_content">(.*)</div>|isU', $content, $data)){
					$title = get_safe_string($data[1]);
					$content = get_safe_string($data[2]);
					$update_time = time();
					$sql = "INSERT INTO article (category_id, title, content, url, update_time, view_count) VALUES (1, '{$title}', '{$content}', '{$link}', '{$update_time}', 1)";
					if(!mysql_query($sql, $link_id)){
						echo mysql_error($link_id);
					}else{
						echo "insert id:".mysql_insert_id($link_id)."\n";
					}
				}
			}
		}
	}
	usleep(3500000);
}

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
