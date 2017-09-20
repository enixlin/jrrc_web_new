<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\db;


/* 使用组合模式实现机构类 */

/* 
    组合模式中只有两种对象
        1、组合对象
        2、叶子对象

    上述两种对象都要实现同一套方法
*/

// 报表接口
interface Report {
    function makeReport();

}

class UnitModel extends Model implements Report{

    private $name;
    private $code;
    private $type;
    private $p_id;

    public function connect(){
        $Unit = Yii::$app->db->createCommand('SELECT * FROM jrrc_user')->queryAll();
    }

    //将机构表数据转化为树结构
    public function makeUnitTree($list){
        //历遍
        foreach($list as $key=>$value){

        }
    }




}