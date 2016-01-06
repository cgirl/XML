<?php
/*
访问时，一会用->，一会用[]

利用simplexml对象把xml文件转成数组
对象  用属性名->属性值，才存储变量
数组  用键名->键值，来存储变量
二者区别不大，在js里，对象就可以看成关联数组来操作
*/
header("content-type:text/xml;charset=utf-8");

/* $simxml = simplexml_load_file('./037_book.xml');
print_r($simxml);
echo '<hr>'; */

/* //类型强制转换，把对象转成数组
print_r((array) $simxml); */

//写一个函数，递归把simpleXML对象转成数组
//思路：先把最外层对象转成数组，再循环数组；某个单元只要还是对象，就继续调用自身来转换
/* function toArray($sim){
    $arr = (array) $sim;
    foreach ($arr as $k=>$v){
        if($v instanceof simplexmlelement || is_array($v)){
            $arr[$k] = toArray($v);
        }
    }
    
    return $arr;
}
$xmlarr = toArray($simxml);
echo $xmlarr['book']['2']['title'];
echo '<hr>'; */

/*
数组转换成XML
*/
//1 一维数组转XML
//思路：循环数组每个单元，加入到xml文档节点中去
/* $arr = array(
    'name'=>'丁三',
    'age'=>29,
);

function arr2xml($arr){
    $simxml = new simpleXMLElement('<?xml version="1.0" encoding="utf-8"?><root></root>');
    //simpleXMLElement对象如何添加子节点
    foreach ($arr as $k=>$v){
        $simxml->addChild($k, $v);
    }
    
    return $simxml->savexml();
}

echo arr2xml($arr); */

$arr = array(
    'name'=>'丁三',
    'age'=>29,
    'job'=>array(
        'title'=>'经理',
        'salary'=>8888,
        'team'=>array('小红','小华','小宁'),
    )
);

function arr2xml($arr, $node=null){
    if($node === null){
        $simxml = new simpleXMLElement('<?xml version="1.0" encoding="utf-8"?><root></root>');
    } else {
        $simxml = $node;
    }
    //simpleXMLElement对象如何添加子节点
    foreach ($arr as $k=>$v){
        if(is_array($v)){
            arr2xml($v, $simxml->addChild($k));
        }else if(is_numeric($k)){
            $simxml->addChild('item', $v);
        }
        else{
            $simxml->addChild($k, $v);
        }
    }

    return $simxml->savexml();
}

echo arr2xml($arr);
?>