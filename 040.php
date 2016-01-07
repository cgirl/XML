<?php
header("content-type:text/html;charset=utf-8");
/*
XPATH，XQuery，是专门来查询xml的语言
查询xml非常快

宇宙霹雳无敌光速XML查询器
*/

//构造一个XPATH查询器
$xml = new DOMDocument('1.0', 'utf-8');
$xml->load('./037_book.xml');

$xpath = new DOMXPATH($xml);

/* $sql = ''; //路径表达式

$xpath->query($sql); */

/*
xpath的路径表达式如何写？
xpath是从根节点到某个节点经过的路径

*/

//查询034_w.xml下面的每本书的title
// 如/bookstore/book/title

$sql = '/bookstore/book/title';
$rs = $xpath->query($sql);
print_r($rs);

echo '<br/>', $rs->item(1)->nodeValue,'<br/>';

//查询book.xml下面的book节点下面的第2个title节点，哪来的第2个title节点？
/* $sql1 = '/bookstore/book/title[2]';
$rs1 = $xpath->query($sql1);
print_r($rs1->length); */

//查询bookstore下面的第2本书下面的title节点
$sql2 = '/bookstore/book[2]/title';
$rs2 = $xpath->query($sql2);
print_r($rs2);
echo '<br />',$rs2->item(0)->nodeValue,'<br />';

//查询/bookstore下面的book节点并且价格大于200元的
$sql3 = '/bookstore/book[price<20]/title';
$rs3 = $xpath->query($sql3);
print_r($rs3);
echo '<br />',$rs3->item(0)->nodeValue,'<br />';

//查询7日通的价格
// /bookstore下面的book，且title==7日通的书的价格
$sql4 = '/bookstore/book[title="Jquery 7日通"]/price';
$rs4 = $xpath->query($sql4);
print_r($rs4);
echo '<br />',$rs4->item(0)->nodeValue,'<br />';

//////////////////////////////////////////////////////////////////////
/*
xpath如何不考虑路径的层次，来查询某个节点

比如，我们刚才严格层次查询 /bookstore/book/title
现在我们加了一个<a><title></title></a>
*/
$sql5 = '/bookstore/book[last()]/title';
$rs5 = $xpath->query($sql5);
print_r($rs5);

//只能查到书名的title
echo '<br />',$rs5->item(0)->nodeValue,'<br />';

//思考，如何查询所有的title，不考虑层次关系
/*
/a/b，这说明，a，b就是父子关系，而如果用/a//b，这说明a只要是b的祖先就可以，忽略了层次
*/

//不分层次，查出所有的title
$sql6 = '//title';
foreach ($xpath->query($sql6) as $v){
    echo $v->nodeValue.'<br>';
}
echo '<hr>';

$sql7 = '//title[1]';
foreach ($xpath->query($sql7) as $v){
    echo $v->nodeValue.'<br>';
}

?>