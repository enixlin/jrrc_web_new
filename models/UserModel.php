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
        $session = Yii::$app->session;
        $all_user=Yii::$app->db->createCommand('SELECT * FROM jrrc_user ')->queryAll();
        foreach($all_user as $user){
            if($user['id']==$id && $user["password"]==$password){
                $session['username']=$user['name'];
                $session['id']=$user['id'];
                return $user;
            }
        }
        return null;
    }


    /* 取得用户的角色 */
    public function GetUserRole($id){
    $all_role=Yii::$app->db->createCommand("SELECT * FROM jrrc_role ")->queryAll();
    return $all_role;
    }


    /* 将用户选择的角色保存入session */
    public function UseRole($roleId,$role_name){
        $session = Yii::$app->session;
        $session['roleId']=$roleId;
        $session['role_name']=$role_name;
        return 1;
    }
}