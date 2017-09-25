<?php
namespace app\models;

use yii;
use yii\base\Model;

class RolerMOdel extends Model
{

    /* 添加角色 */
    public function addRoler($rolerName, $status)
    {
        $result=Yii::$app->db->createCommand("insert into jrrc_roler (roler_name,status) values($rolerName,$status)")->queryAll();
        return $result;
    }

    /* 删除角色 */
    public function deleteRoler($id)
    {
        $result=Yii::$app->db->createCommand("delete from jrrc_roler where id=$id")->queryAll();
        return $result;
    }

    /* 修改角色 */
    public function modifyRoler($roleName,$status,$id)
    {
        $result=Yii::$app->db->createCommand("update jrrc_roler set (roler_name=$rolerName,status=$status) where id=$id")->queryAll();
        return $result;
    }
}
