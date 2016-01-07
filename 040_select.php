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

$xpath = new DOMXPATH($xml);

$sql = '/dict/word[mean="'.$word.'"]/mean';
$words = $xpath->query($sql);
if ($words->length == 0){
    echo 'sorry';
    exit;
}

//查到了
$goods = $words->item(0);

echo '货号：'.$word.'<br />';
echo '名字：',$goods->nextSibling->nodeValue,'<br />';
echo '价钱：',$goods->nextSibling->nextSibling->nodeValue,'<br />';

//////////////////////////////////////////////////////
$xml->loadhtmlfile('./039.html');

$xpath = new DOMXPATH($xml);
$sql1 = '//h2';
echo $xpath->query($sql1)->item(0)->nodeValue;
echo '<hr>';

//查询id="abc"的div节点
$sql = '//div[@id="abc"]';
echo $xpath->query($sql)->item(0)->nodeValue;
echo '<br />';

//分析第2个div下的p下的相邻span的第2个span的内容
$sql = '//div/p/span[2]';
echo $xpath->query($sql)->item(0)->nodeValue;
?>