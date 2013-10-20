<?php
error_reporting(E_ALL^E_NOTICE);
include APP_ROOT.'global.func.php';

//init();
//$conn = new Mongo;
//$db = $conn->swordfish;
//$collection = $db->product;

$link = mysql_pconnect('127.0.0.1', 'root', '32100321') or die('mysql connect:'.mysql_error());
mysql_select_db('swordfish', $link);
?>
