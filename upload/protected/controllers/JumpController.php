<?php
/**
 * 页面跳转处理
 */
class JumpController extends Controller {
    public function actionProduct($idstr){
        $conn = new Mongo();
        $products = $conn->swordfish->product;
        $product = $products->findOne(array('_id' => new MongoId($idstr)));
        header('Location:'.$product['url']);
    }
    public function actionUrl($goto){
        $urls = array(
            'dangdang' => 'http://www.dangdang.com/',
            'jd' => 'http://www.jd.com/',
        );
        header('Location:'.$urls[$goto]);
    }
}
?>
