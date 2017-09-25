<?php
namespace app\controllers;

use yii;
use yii\base\Controller;

class UserController extends Controller
{
    private $userModel;

    // public function __construct(){
    //     $this->userModel=new \app\models\UserModel();
    // }

    public function actionIndex()
    {

        // $userModel =new \app\models\UserModel();
        // $arraylist=$userModel->getAvailableUsersNames();
       //  return $userModel->getAvailableUsersNames();
      // $arraylist=$this->userModel->getAvailableUsersNames();
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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $userModel=new \app\models\UserModel();
        $id = $request->post('id');
        $password=$request->post('password');
       return $userModel->ValitPassword($id,$password);
    }

     /* 取得用户的角色 */
     public function actionGetUserRole(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         $id=$_SESSION['id'];
         $userModel=new \app\models\UserModel();
        return  $userModel->GetUserRole($id);
      }


      /* 将用户选择的角色保存入session */
      public function actionUseRole(){
        $request = Yii::$app->request;
        $roleId = $request->post('roleId');
        $role_name=$request->post("role_name");
        $userModel=new \app\models\UserModel();
        return $userModel->UseRole($roleId,$role_name);
      }



}
