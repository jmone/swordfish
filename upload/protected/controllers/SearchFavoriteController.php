<?php

class SearchFavoriteController extends Controller {

    public $layout = "//chagou/main";

    public function init(){
        //判断用户是否为登录状态
        if (empty(Yii::app()->session['user'])) {
            $this->render("//common/message", array(
                'type' => 'error',
                'message' => '您现在为登出状态，请<a href="/user/login">登录</a>后再操作'
            ));
            Yii::app()->end();
        }
    }
    public function actionAdd() {
        $this->pageTitle = "收藏";
        //添加收藏
        $result = Yii::app()->db->createCommand()
                ->insert('{{search_favorite}}', array(
            'user_id' => Yii::app()->session['user']['id'],
            'text' => trim($_GET['k']),
            'dateline' => time(),
        ));
        if ($result) {
            $type = 'success';
            $message = '您已成功收藏该记录，查看<a href="/searchFavorite/list">收藏列表</a>';
        } else {
            $type = 'error';
            $message = 'Sorry，系统内部错误，请联系管理员，说不定有奖哦';
        }
        $this->render('//common/message', array(
            'type' => $type,
            'message' => $message,
        ));
        Yii::app()->end();
    }

    public function actionList() {
        $this->pageTitle = "收藏列表";
        $favorites = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{search_favorite}}')
                ->where('user_id = :uid', array(
                    ':uid' => Yii::app()->session['user']['id'],
                    ))->queryAll();
        $this->render('list', array(
            'favorites' => $favorites,
        ));
    }

    public function actionRemove() {
        $this->pageTitle = "删除收藏记录";
        
        $result = Yii::app()->db->createCommand()
                ->delete('{{search_favorite}}', 'id = :id AND user_id = :uid', array(
                    ':id' => $_GET['id'],
                    ':uid' => Yii::app()->session['user']['id'],
                ));
        if ($result) {
            $type = 'success';
            $message = '您已成功删除该记录，返回<a href="/searchFavorite/list">收藏列表</a>';
        } else {
            $type = 'error';
            $message = '系统内部错误，请联系管理员，说不定有奖哦，返回<a href="/searchFavorite/list">收藏列表</a>';
        }
        $this->render('//common/message', array(
            'type' => $type,
            'message' => $message,
        ));
        Yii::app()->end();
    }

}

?>
