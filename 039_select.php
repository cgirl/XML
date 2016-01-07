<?php
header("content-type:text/html;charset=utf-8");

//接收单词并解析XML查询响应的单词
$word = isset($_GET['word'])?trim($_GET['word']):'';

if(empty($word)){
    exit('你想查啥？');
}


//解析XML并查询
$xml = new DOMDocument('1.0', 'utf-8');
$xml->load('./039_dict.xml');

$namelist = $xml->getElementsByTagName('mean');
foreach ($namelist as $v){
    if($v->nodeValue == $word){
        //print_r($v);
        echo '货号：'.$word.'<br />';
        echo '名字：',$v->nextSibling->nodeValue,'<br />';
        echo '价钱：',$v->nextSibling->nextSibling->nodeValue,'<br />';
        break;
    }else{
        echo '抱歉没有该商品';
    }
}
?>