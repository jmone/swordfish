<?php

class ProductController extends Controller {

    public $layout = "//product/layout";

    public function actionGetMongo($id){
        $mongoid = new MongoId($id);
        $conn = new Mongo();
        $db = $conn->swordfish;
        $collection = $db->product;
        $product = $collection->findOne(array(
            '_id' => $mongoid,
        ));
        $conn->close();
        
        $this->render('get', array(
            'product' => $product,
        ));
    }
    public function actionGet($id){
        $product = Yii::app()->db->createCommand()->select('*')->from('product')->where('id=:id', array(':id'=>intval($id)))->queryRow();
 
        require 'sphinxapi.php';
	$page = 1;
	$size = 30;
        $cl = new SphinxClient ();
        $cl->SetServer('127.0.0.1', 9312);
        $cl->SetArrayResult(true);
	$cl->SetFilterFloatRange('sale_price', 0.1, 1000000.0);
        $cl->SetLimits(($page-1)*$size, $size);
        $cl->SetMatchMode(SPH_MATCH_ANY);
        $res = $cl->Query( '@title ('.$product['title'].')' , "*");

	$data['docsid'] = array();
	if(count($res['matches']) > 0){
		foreach($res['matches'] as $item){
			$data['docsid'][] = $item['id'];
		}
	}
	$moreproducts= Yii::app()->db->createCommand()->select('*')->from('product')->where(array('in', 'id', $data['docsid']))->queryAll();
       
        $this->render('get', array(
            'product' => $product,
	    'moreproducts' => $moreproducts,
        ));
    }

}

?>
