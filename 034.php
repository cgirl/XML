<?php
header("Content-Type:text/html;charset=utf-8");
/*
用DOM来创建XML文档
1.先创建“天龙八部”文本节点
2.再创建普通的name节点
3.在把天龙文本节点加入到name节点中
4.创建cdata节点
5.再创建intro节点
6.再把cdata节点放入intro中
7.创建goods节点
8.把name，intro放入goods节点
9.创建属性节点goods_id
10.把属性节点放入goods节点
11.创建appstore节点
12.把goods放入appstore节点
13.把appstore放入文档中

在上面的步骤中，体现出：
创建普通节点
创建CDATA节点
创建属性节点
增加子节点
*/
//创建DOM文档对象
$dom = new Domdocument('1.0', 'utf-8');

//创建文本节点
$tl = $dom->createTextNode('天龙八部');

//创建普通节点
$name = $dom->createElement('name');

//在把天龙文本节点加入到name节点中
$name->appendChild($tl);

//创建cdata节点
$cdata = $dom->createCDATASection('天龙八部~~~~');

//再创建intro节点
$intro = $dom->createElement('intro');

//再把cdata节点放入intro中
$intro->appendChild($cdata);

//创建goods节点
$goods = $dom->createElement('goods');

//把name，intro放入goods节点
$goods->appendChild($name);
$goods->appendChild($intro);

//创建属性节点goods_id
$goods_id = $dom->createAttribute('goods_id');
$goods_id->value = 'j001';

//把属性节点放入goods节点
$goods->appendChild($goods_id);

//创建appstore节点
$appstore = $dom->createElement('appstore');

//把goods放入appstore节点
$appstore->appendChild($goods);

//把appstore放入文档中
$dom->appendChild($appstore);

//最后，想输出也行，想保存也可以
//echo $dom->savexml();

echo $dom->save('034_w.xml')?'ok':'fail';
?>