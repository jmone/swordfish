<?php
header("Content-type:text/html; charset=utf-8");

$sendStr="\n健康与美学";
$socket=socket_create(AF_INET,SOCK_STREAM,getprotobyname("tcp"));

if(socket_connect($socket,"127.0.0.1",8080)){

	socket_write($socket,$sendStr,strlen($sendStr));

	$receiveStr="";
	$receiveStr=socket_read($socket,1024);
	echo "client:".$receiveStr."\n";  
	$data = json_decode($receiveStr, true);
	print_r($data);

}
socket_close($socket);

?>
