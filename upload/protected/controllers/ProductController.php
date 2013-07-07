<?php

class ProductController extends Controller {

    public $layout = "//product/layout";

    public function actionGet($id){
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
}

?>
