<?php
	error_reporting(E_ALL);
	//报告所有错误
	$content = "文字基本读写<br />";
	$file = 'd://filedemo.txt';
	$f= fopen($file,'wb');
	fwrite($f, $content,strlen($content));//以上是打开文件写入内容
	$content = "数据持久化的一种手段";
	fwrite($f, $content,strlen($content));
	fclose($f);
	echo '<b><font color="red">以下为fread函数的演示：</font></b><br />';
	//fread（）从打开的文件中读取指定的长度字符串
	$f = fopen($file,'rb');
	$read_content = fread($f,4);
	echo $read_content;
	echo '<br /><b><font color="red">以下为fgets函数的演示：</font></b><br />';
	//fgets从文件中读取一行内容
	$read_content = fgets($f);
	echo $read_content;
	fclose($f);
	echo '<br /><b><font color="red">以下为fgetc函数的演示：</font></b><br />';
	//fgetc函数在打开的资源总读取当前指针位置处的一个字符，需要重新初始化
	$f = fopen($file,'rb');
	while (FALSE!==($char=fgetc($f))) {
		echo $char;
	}
	fclose($f);
	echo '<br /><b><font color="red">以下为file_get_contents()函数的演示：</font></b><br />';
	//file_get_contents函数将整个文件读入一个字符串
	$read_content = file_get_contents($file);
	echo '<br /><b><font color="red">以下为file函数的演示：</font></b><br />';
	//file函数将文件读入到一个数组中
	$read_content = file($file);
	print_r($read_content);
	echo '<br /><b><font color="red">以下为readfile()函数的演示：</font></b><br />';
	//readfile函数读取整个文件，立即输出至输出缓冲区
	readfile($file);
?>