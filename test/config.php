<?php
$config = array(
        "index" => array(
                "source" => "mongo",
                "host" => "127.0.0.1",
                "port" => "27017",
        ),
        "indexpath" => "/data/swordfish/swordfish.index",
        "search" => array(
                "port" => "12306",
        ),
);
echo json_encode($config);
?>
