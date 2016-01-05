<?php
/*
 * $key = abe95e495c0820cc;
 * echo $api，得到的是一个XML文档，内容是视频的标题，时长，封面等等信息。接下来，我们要做的是用PHP把
 * XML的各节点信息解析出来。
 * 
 * 知识：DOMDocument类来解析
 * 
 * 当前，我们暂时不用XML解析，而是直接用字符串操作来得到地址
 */
error_reporting(E_ALL & ~E_NOTICE);
$key = 'abe95e495c0820cc';
if ($tudou = $_POST['tudou']){
    
    $itemCode = basename($tudou);
    
    $api = 'http://api.tudou.com/v3/gw?method=item.info.get&appKey='.$key.
    '&format=xml&itemCodes='.$itemCode;
    
    //echo $api;
    $source = file_get_contents($api);
    $start = strpos($source, '<html5Url>');
    $end = strpos($source, '</html5Url>');
    $noad = substr($source, $start, $end-$start);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>xml历史及特点</title>
</head>
<body>
	<pre>
		第28集：http://www.tudou.com/albumplay/bHQgbXXsD-w/vSiti0Uvtgc.html
	</pre>
	<h1>这个地址需要支持html5的浏览器才能看到，如chrome，火狐，IE9以上</h1>
	<form method="post">
		<p>
			土豆地址：<input type="text" name="tudou" />
		</p>
		<input type="submit" value="获取地址" />
	</form>
	<p>无广告地址:<?php echo $noad;?></p>
</body>
</html>