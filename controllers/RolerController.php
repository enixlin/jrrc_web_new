<?php

namespace app\controllers;

use yii;
use yii\base\Controller;

class RoleController extends Controller
{
   private $RolerModel;

   public function __construct(){
       $this->RolerModel=new app\models\RolerModel();
   }

    /* 添加角色 */
    public function actionAddRoler()
    {
        $request=Yii::$app->request;
        $roleName = $request->post('roleName');
        $status='1';
      
        return $this->RolerModel->addRoler($roleName, $status);
    }

    /* 删除角色 */
    public function actionDeleteRoler()
    {
        $request=Yii::$app->request;
        $id=$request->post('id');
        
        $RolerModel=new app\models\RolerModel();
    }

    /* 修改角色 */
    public function actionModifyRoler()
    {
    }
}
