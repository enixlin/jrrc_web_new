<?php
/* 组合模式 */

/* 组合结构 */
class Composite
{
    public $name;
    public $children;
    public $type;

    public function __construct($name)
    {
        $this->children=array();
        $this->name=$name;
        $this->type='composite';
    }

    public function addChildren($child)
    {
        $this->children[$child->name]=$child;
    }

    public function deleteChildren()
    {
    }

    public function getChildren($name)
    {
        // 接收叶子类型 的对象，放到elements数组
        $elements = array();
        // 判断对象是否为leaf类型，如果是直接加到elements数组当中
        function arrayEach($ArrayObject, &$array)
        {
            foreach ($ArrayObject as $key => &$value) {
                $e=$value;
                if (isset($e) && is_array($e)) {
                    arrayEach($e, $array);
                } else {
                    $array[$key]=$value;
                }
            }
            return $array;
        }
        arrayEach($this->children[$name],$elements);
        return $elements;
    }

    public function fun($name)
    {
        $object=$this->getChildren($name);
        foreach ($object as $key => $value) {
        }
    }
}
           

/* 叶子结构 */
class Leaf
{
    public $name;
    public $children;
    public $type;

    public function __construct($name)
    {
        $this->name=$name;
        $this->type='leaf';
    }

   
    public function fun($name)
    {
        echo $name+" do fun";
    }
}



$rh=new Composite("总行");

$guojibu=new Composite("国际部");

$client=new Leaf("振业水产");

$guojibu->addChildren($client);
$rh->addChildren($guojibu);


//var_dump($rh);
//$rh->fun($rh->name);
$rh->fun("国际部");
