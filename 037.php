<?php
header('content-type:text/html;charset=utf-8');
/*
DOMDocument来解析，操作XML

XML文件的解析，分这么几步：
1.得到面
$xml = new Domdocument('1.0', 'utf-8');
$xml->load('xxx.xml');

2.得到串（节点列表对象，nodelist Object）
$xml->getElementsByTagName('节点名');

3.得到点（节点/元素）
$nodelist->item(0/1/2....);

利用DOM标准来层层解析XML，思路明确，但是稍麻烦

今天内容：
2个知识点：simpleXML， xpath
1个实战：用XML充当数据库，做词典查询

simpleXML解析XML文件非常简单，因为它一次性把XML文件解析成一个大对象
*/
$simple = simplexml_load_file('./037_book.xml');
//print_r($simple);

//echo $simple->book[1]->title;

//看看bookstore下面有几本书
echo '有'.$simple->count().'个子元素<br /><hr>';

$sons = $simple->children();
foreach ($sons as $s){
    echo '分别有'.$s->count().'子元素<br />';
}

?>