<?php
namespace app\controllers;

use Yii;

use yii\web\Controller;
//use app\models;


class LoginController extends Controller
{

    public $layout = 'blank';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin(){
        
    }

    public function actionLogout(){
        $session = Yii::$app->session;
        $_SESSION['role_name']=null;
        $_SESSION['roleId']=null;
        return $this->render('index');
    }


    


}
