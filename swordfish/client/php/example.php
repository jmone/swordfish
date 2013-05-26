<?php

$sendStr="client";
$socket=socket_create(AF_INET,SOCK_STREAM,getprotobyname("tcp"));

if(socket_connect($socket,"127.0.0.1",8080)){

while(true){
	socket_write($socket,$sendStr,strlen($sendStr));
	
	$receiveStr="";
	$receiveStr=socket_read($socket,1024);
	echo "client:".$receiveStr;  
}

}
socket_close($socket);

?>
