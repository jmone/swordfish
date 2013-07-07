<?php

class UserController extends Controller {

    public $layout = "//chagou/main";

    public function actionRegister() {
        $this->pageTitle = "注册用户";
        if(isset($_POST['user'])){
            //判断email是否存在
            $cnt = Yii::app()->db->createCommand()
                    ->select('count(*)')
                    ->from('{{user}}')
                    ->where('email = :email', array(
                        ':email' => $_POST['user']['email'],
                    ))->queryScalar();
            if($cnt >= 1){
                $this->render('//common/message', array(
                    'type' => 'error',
                    'message' => '该邮箱已经被注册，<a href="/user/register">重试</a>',
                ));
                Yii::app()->end();
            }
            //不存在，注册之
            $dateline = time();
            $result = Yii::app()->db->createCommand()
                    ->insert('{{user}}', array(
                        'email' => $_POST['user']['email'],
                        'password' => md5($_POST['user']['password'].$dateline),
                        'dateline' => $dateline,
                    ));
            if($result){
                $type = 'success';
                $message = '恭喜，注册成功，立即<a href="/user/login">登录</a>';
            }else{
                $type = 'error';
                $message = 'Sorry，系统内部错误，请联系管理员，说不定有奖哦，<a href="/user/register">重试</a>';
            }
            $this->render('//common/message', array(
                'type' => $type,
                'message' => $message,
            ));
            Yii::app()->end();
        }
        $this->render("register");
    }

    public function actionLogin() {
        $this->pageTitle = "用户登录";
        if(isset($_POST['user'])){
            $user = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('{{user}}')
                    ->where('email = :email', array(
                        ':email' => $_POST['user']['email'],
                    ))->queryRow();
            if(empty($user)){
                $type = 'error';
                $message = '该邮箱不存在，<a href="/user/login">重试</a>';
            }else{
                $password = md5($_POST['user']['password'].$user['dateline']);
                if($user['password'] == $password){
                    Yii::app()->session['user'] = $user;
                    $type = 'success';
                    $message = '恭喜，登录成功，回到<a href="/">首页</a>';
                }else{
                    $type = 'error';
                    $message = '登录失败，邮箱与密码不匹配，<a href="/user/login">重试</a>';
                }
            }
            $this->render('//common/message', array(
                'type' => $type,
                'message' => $message,
            ));
            Yii::app()->end();
        }
        $this->render("login");
    }

    public function actionLogout() {
        $this->pageTitle = "退出登录";
        Yii::app()->session['user'] = null;
        $this->render("//common/message", array(
            'type' => 'success',
            'message' => '您已经成功登出，回到<a href="/">首页</a>或<a href="/user/login">登录</a>'
        ));
    }

    public function actionChangePassword(){
            $this->render("//common/message", array(
                'type' => 'success',
                'message' => '功能开发中！'
            ));
            Yii::app()->end();
    }
    
    public function actionCenter(){
        $this->render('/searchFavorite/list');
    }
}

?>
