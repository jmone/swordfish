<?php
header("Content-type:text/html; charset=utf-8");

$sendStr=trim($_GET["k"]);
if(empty($sendStr)){
	die("请输入关键字");
}
$socket=socket_create(AF_INET,SOCK_STREAM,getprotobyname("tcp"));

if(socket_connect($socket,"127.0.0.1",8080)){

	socket_write($socket,$sendStr,strlen($sendStr));

	$receiveStr="";
	$receiveStr=socket_read($socket,1024);
	$data = json_decode($receiveStr, true);
	echo "<pre>";
	print_r($data);
	echo "</pre>";

}
socket_close($socket);

?>
