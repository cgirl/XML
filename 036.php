<?php
/*
连接数据库，动态生成rss，feed
连接数据库，取最新的10条商品
*/

class feed{
    protected $dom = null;
    protected $rss = null;
    
    public $title = ''; //channel的title
    public $link = '';  //channel的link
    public $description = ''; //channel的description
    public $template = './036.xml'; //xml模板
    public $items = array();
    
    public function __construct(){
        $this->dom = new Domdocument('1.0', 'utf-8');
        $this->dom->load($this->template);
        $this->rss = $this->dom->getElementsByTagName('rss')->item(0);
    }
    
    //封装一个方法，直接创建例如<ele>text</ele>这样的节点
    protected function createEle($name, $value){
        $ele = $this->dom->createElement($name);
        $text = $this->dom->createTextNode($value);
        $ele->appendChild($text);
        
        return $ele;
    }
    
    //封装addItem方法，把所有的商品增加到RSS里面去
    //$list是商品列表，是二维数组，每一行是一个商品
    protected function addItem($list){
        foreach ($list as $goods){
            $this->rss->appendChild($this->createItem($goods));
        }
    }
    
    //封装一个方法，用来造item
    protected function createItem($arr){
        $item = $this->dom->createElement('item');
        foreach ($arr as $k=>$v){
            $item->appendChild($this->createEle($k, $v));
        }
        
        return $item;
    }
    
    //封装createChannel方法，用来创建rss的唯一且必须的channel节点
    protected function createChannel(){
        $channel = $this->dom->createElement('channel');
        $channel->appendChild($this->createEle('title', $this->title));
        $channel->appendChild($this->createEle('link', $this->link));
        $channel->appendChild($this->createEle('description', $this->description));
        
        $this->rss->appendChild($channel);
    }
    
    //调用createItem，把所有的额item节点都成生成，再输出
    public function display(){
        $this->createChannel();
        $this->addItem($this->items);
        header('content-type:text/html;charset=utf-8');
        echo $this->dom->savexml();
    }
}

$conn = mysql_connect('localhost', 'root', '123456');
$test = mysql_query('set names utf8', $conn);

mysql_query('use ecshop');
$sql = 'select goods_sn as title, goods_name as description from ecs_goods order by add_time desc limit 8';
$rs = mysql_query($sql, $conn);
$list = array();

while ($row = mysql_fetch_assoc($rs)){
    $list[] = $row;
}

$feed = new feed();
$feed->title = '布尔商城';
$feed->link = 'http://www.baidu.com';
$feed->description = '百度官方网站';
$feed->items = $list;

$feed->display();

?>