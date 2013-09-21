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
        
        $this->render('get', array(
            'product' => $product,
        ));
    }

}

?>
