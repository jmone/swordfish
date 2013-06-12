<?php

class IndexController extends Controller {

    public $layout = "//index/column";

    public function actionIndex() {
        $this->pageTitle = "比价搜索";
        $this->render("index");
    }

    public function actionSearch() {
        $sendStr = trim($_GET["k"]);
        if (empty($sendStr)) {
            $this->rediect('index');
        }
        $this->pageTitle = $sendStr."的搜索结果";
        //执行搜索
        $socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname("tcp"));
        if (socket_connect($socket, "127.0.0.1", 8080)) {
            socket_write($socket, $sendStr, strlen($sendStr));
            $receiveStr = "";
            $receiveStr = socket_read($socket, 1024);
            $data = json_decode($receiveStr, true);
//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";
        }
        socket_close($socket);
        //取出对应商品
        $funcGetMongoId = function($idStr) {
                    $mongoid = new MongoId($idStr);
                    return $mongoid;
                };
        $conn = new Mongo();
        $db = $conn->swordfish;
        $collection = $db->product;
        $cursor = $collection->find(array(
            '_id' => array(
                '$in' => array_map($funcGetMongoId, $data['docsid']),
            ),
        ));
        $products = array();
        while($product = $cursor->getNext()){
            $products[] = $product;
        }
//        echo "<pre>";
//        print_r($products);
//        echo "</pre>";
        //渲染页面
        $this->render('list', array(
            'searchData' => $data,
            'products' => $products,
        ));
    }

}

?>
