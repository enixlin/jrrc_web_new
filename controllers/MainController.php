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
        return $this->render('index');
    }

   
}
