<?php
namespace app\controllers;

use Yii;
 use yii\web\Controller;

class MainController extends Controller
{
    //设定控制器的布局
    public $layout = 'blank';
    
    public function actionIndex()
    {
        if(isset($_SESSION["username"])){    
            if (!(isset($_SESSION['roleId'])||isset($_SESSION['role_name'])) ){
                return $this->render('selectRole');
            } else {
                return $this->render('index');
            }
        }else{
            $this->redirect('./../../../jrrc_web_new/web/');
        }
     }
}
