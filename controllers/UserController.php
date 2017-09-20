<?php
namespace app\controllers;

use yii;
use yii\web\Controller;

class UserController extends Controller
{
    private $userModel;

    // public function __construct(){
    //     $this->userModel=new UserModel();
    // }

    public function actionIndex()
    {

         $userModel =new \app\models\UserModel();
         $arraylist=$userModel->getAvailableUsersNames();
       //  return $userModel->getAvailableUsersNames();
        var_dump($arraylist);
    }


    // this
    public function actionGetAvailableUsersNames()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userModel =new \app\models\UserModel();
        return  $arraylist=$userModel->getAvailableUsersNames();
      //var_dump($arraylist);
    }

    /* 验证用证名和密码 */
    public function actionValitPassword()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        echo $id;
    }
}
