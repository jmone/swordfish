<?php

class IndexController extends Controller {

    public $layout = "//chagou/main";

    public function actionIndex() {
        $this->pageTitle = "比价搜索";
        $this->render("//chagou/index");
    }

    public function actionSearch() {
        $input = trim($_GET["k"]);
	$page = intval($_GET["page"]) > 0 ? intval($_GET["page"]) : 1;
        if (empty($input)) {
            $this->redirect('index');
        }
	$sendStr = json_encode(array(
		'input' => $input,
		'page' => $page,
		'size' => 10,
	));
        $this->pageTitle = $input."的搜索结果";
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
        /*
        $funcGetMongoId = function($idStr) {
                    $mongoid = new MongoId($idStr);
                    return $mongoid;
                };
        */
        $funcGetMongoId = create_function('$idStr', '$mongoid = new MongoId($idStr);return $mongoid;');
        $conn = new Mongo();
        $db = $conn->swordfish;
        $collection = $db->product;
        $cursor = $collection->find(array(
            '_id' => array(
                '$in' => array_map($funcGetMongoId, $data['docsid']),
            ),
        ));
        $conn->close();
        $products = array();
        while($product = $cursor->getNext()){
            $products[$product['_id']->{'$id'}] = $product;
        }
//        echo "<pre>";
//        print_r($products);
//        var_dump($products[0]['_id']->{'$id'});
//        echo "</pre>";
        //渲染页面
        $this->render('//chagou/list', array(
            'searchData' => $data,
            'products' => $products,
        ));
    }

}

?>
