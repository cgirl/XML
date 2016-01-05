<?php
header('Content-Type:text/html;charset=utf-8');
/*
XML的DOM解析

document.getElementsByTagName();
childNodes()

这2个方法，是不是有点熟悉呢？
是的，在js，java里也有

为什么？
答：XML是一种严格的文档格式，有其自身的标准，解析XML，也有其标准，叫DOM标准。我们
  -我们所使用的html，xml都遵循DOM标准，也就是为什么我们看到上面的额两个函数那么熟悉。
  -因为无论是PHP，java，c，js解析DOM树，都要遵循同样的DOM标准。
////////////////////////////////////////////////////////////////////////////
如何通过php的DOM对象解析xml
1.要把XML文件读进来，形成了一个XML文档对象<--对应js--> document对象
2.再通过getElementsByTagName（'标签名'）得到一组节点<--js-->
  document.getElementsByTagName()
3.再把第2步中，得到一组对象，取的其某一个，就得到了具体的节点
*/

//1.创建DOM解析对象
$dom = new DOMdocument('1.0', 'utf-8');
/*
DOMdocument Object有什么用？
答：他可以把你的XML文件载入内存并分析，就可以利用object分析xml了
*/
print_r($dom);
echo '<br /><br />';

//2.载入XML文档
$dom->load('./033.xml');

//3.得到title节点列表
/*
分析：title节点有很多，因此得到的是"节点列表对象"
*/
$ts = $dom->getElementsByTagName('title');
//print_r($ts);

/*
DOMNodelist
有1个属性：length 代表取得的节点数量
有1个方法：item（N）代表取得第n个节点
*/
/*
echo '我们得到了'.$ts->length.'个书名<br />';
echo '第一个节点是';print_r($ts->item(0));
*/
//“天龙八部”是一个文本节点，而且是<title></title>的子节点
$title0 = $ts->item(0);
//print_r($title0->childNodes); //打印结果是一个列表对象
//echo '<br /><br />';

echo '现在有'.$title0->childNodes->length.'个节点<br /><br />';
$text= $title0->childNodes->item(0);
//print_r($text);
echo $text->wholeText.'<br />';
echo $dom->getElementsByTagName('title')->item(1)->childNodes->item(0)->wholeText;

echo '<br />';
echo $dom->getElementsByTagName('title')->item(1)->nodeValue;