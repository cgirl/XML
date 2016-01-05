<?php
/*
DOM操作XML的节点读取，节点创建与删除

节点能不能修改与删除
*/

//创建DOM对象
$dom = new Domdocument('1.0', 'utf-8');

//载入xml
$dom->load('./035.xml');

//把天龙八部的商品删除
//查找goods节点，得到列表，从列表中选取天龙八部节点
$tl = $dom->getElementsByTagName('goods')->item(0);
$tl->parentNode->removeChild($tl);

//删除节点以及搞定
/* header('content-type:text/xml;charset=utf-8');
echo $dom->savexml(); */

//修改节点，节点不能修改，只能替换
$name = $dom->getElementsByTagName('name')->item(0);
$text = $dom->createTextNode('电视剧');
$name->replaceChild($text, $name->firstChild);

header('content-type:text/xml;charset=utf-8');
echo $dom->savexml();
?>