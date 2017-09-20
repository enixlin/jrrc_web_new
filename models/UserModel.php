<?php
namespace app\models;
use yii;
use yii\base\Model;



class UserModel extends Model{
    public function getAvailableUsersNames(){
       return $Users = Yii::$app->db->createCommand('SELECT * FROM jrrc_user')->queryAll();
    }


}