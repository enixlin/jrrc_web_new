<?php
namespace app\models;
use yii;
use yii\base\Model;



class UserModel extends Model{
    /* 取得所有的用户信息 */
    public function getAvailableUsersNames(){
       return $Users = Yii::$app->db->createCommand('SELECT * FROM jrrc_user where status=1')->queryAll();
    }

    /* 验证用证名和密码 */
    public function ValitPassword($id,$password){
        $all_user=Yii::$app->db->createCommand('SELECT * FROM jrrc_user ')->queryAll();
        foreach($all_user as $user){
            if($user['id']==$id && $user["password"]==$password){
                return $user;
            }
        }
        return null;
    }

}