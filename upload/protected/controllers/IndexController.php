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
	$size = 10;
        if (empty($input)) {
            $this->redirect('index');
        }
        $price = trim($_GET['price']);
        if (empty($price)) {
            $price = "0;100000";
        }
        $priceorder = trim($_GET['priceorder']);
        if (!in_array($priceorder, array('asc', 'desc'))) {
            $priceorder = 'null';
        }
        list($startprice, $endprice) = explode(';', $price);
	$startprice = floatval(trim($startprice));
	$endprice = floatval(trim($endprice));

        require 'sphinxapi.php';
        $cl = new SphinxClient ();
        $cl->SetServer('127.0.0.1', 9312);
        $cl->SetArrayResult(true);
	$cl->SetFilterFloatRange('sale_price', $startprice, $endprice);
        $cl->SetLimits(($page-1)*$size, $size);
        $cl->SetMatchMode(SPH_MATCH_EXTENDED);
	if($priceorder == 'asc'){
		$cl->SetSortMode(SPH_SORT_ATTR_ASC, 'sale_price');
	}elseif($priceorder == 'desc'){
		$cl->SetSortMode(SPH_SORT_ATTR_DESC, 'sale_price');
	}
        $res = $cl->Query( '@title ('.$input.')' , "*");

        header('Content-type:text/html; charset=utf-8');
        //echo '<pre>';
        //print_r($res);
        //print_r($cl->GetLastError());
        //print_r($cl->GetLastWarning());
        //echo '</pre>';
	foreach($res['matches'] as $item){
		$data['docsid'][] = $item['id'];
	}
	$data['original'] = array(
		0 => $input,
		1 => $res['total'],
		2 => $page,
		3 => $size,
	);
	foreach($res['words'] as $word => $hits){
		$data['words'][] = $word;
	}
	$productsData = Yii::app()->db->createCommand()->select('*')->from('product')->where(array('in', 'id', $data['docsid']))->queryAll();
	foreach($productsData as $product){
		$products[$product['id']] = $product;
	}
        $this->pageTitle = $input . "的搜索结果";
        $this->render('//chagou/list', array(
            'searchData' => $data,
            'products' => $products,
            'price' => $price,
            'priceOrder' => $priceorder,
        ));
    }

    public function actionSearchSwordfish() {
        $input = trim($_GET["k"]);
        $page = intval($_GET["page"]) > 0 ? intval($_GET["page"]) : 1;
        if (empty($input)) {
            $this->redirect('index');
        }
        $price = trim($_GET['price']);
        if (empty($price)) {
            $price = "0;100000";
        }
        $priceorder = trim($_GET['priceorder']);
        if (!in_array($priceorder, array('asc', 'desc'))) {
            $priceorder = 'null';
        }
        list($startprice, $endprice) = explode(';', $price);
        $sendStr = json_encode(array(
            'input' => $input,
            'page' => $page,
            'size' => 10,
            'startprice' => intval($startprice),
            'endprice' => intval($endprice),
            'priceorder' => $priceorder,
        ));
        $this->pageTitle = $input . "的搜索结果";
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
        while ($product = $cursor->getNext()) {
            $products[$product['_id']->{'$id'}] = $product;
        }
//        echo "<pre>";
//        print_r($products);
//        var_dump($products[0]['_id']->{'$id'});
//        echo "</pre>";
        //渲染页面
	print_r($data);
	print_r($products);
	print_r($price);
	print_r($priceorder);
        $this->render('//chagou/list', array(
            'searchData' => $data,
            'products' => $products,
            'price' => $price,
            'priceOrder' => $priceorder,
        ));
    }

}

?>
