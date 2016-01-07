<?php
/*
XML的应用场景
1.做配置文件，如QQ里的配置文件。在java项目中，XML的配置文件多的数不清
2.数据传输，如webservice，网站开放的api，如土豆的视频信息获取
3.小型数据库
  比如，我们有一个6级但单词库，在数据库中是这种形式
  id      word      mean
  1       score     分数
  2       title     标题
  ......
  
 <?xml ... ?>
 <dict>
    <word id="u1">
        <name>score</name>
        <mean>分数</mean>
    </word>
    <word id="u2">
        <name>title</name>
        <mean>标题</mean>
    </word>
    ......
 </dict>
 
利用Xml做小型数据库，做一个在线词典查询
1.把数据库的单词导入到XML文件
2.做一个表单用来发送待查询单词
3.做一个查询页面，解析XML，查询该单词
*/
$xml = new DOMDocument('1.0', 'utf-8');
$xml->load('./039.xml');

$conn = mysql_connect('localhost', 'root', '123456');
mysql_query('set names utf8', $conn);
mysql_query('use ecshop', $conn);
$rs = mysql_query('select * from ecs_goods limit 10');
$dict = $xml->getElementsByTagName('dict')->item(0);
while($row = mysql_fetch_assoc($rs)){
    //每一行数据，只要写入到XML的节点中，就可以了
    $lx = $xml->createElement('lx');
    $lx->appendChild($xml->createCDATASection($row['shop_price']));
    
    $mean = $xml->createElement('mean');
    $mean->appendChild($xml->createCDATASection($row['goods_sn']));
    
    $name = $xml->createElement('name');
    $name->appendChild($xml->createtextNode($row['goods_name']));
    
    $word = $xml->createElement('word');
    $word->appendChild($mean);
    $word->appendChild($name);
    $word->appendChild($lx);
    
    $dict->appendChild($word);
}

$xml->save('./039_dict.xml');
?>