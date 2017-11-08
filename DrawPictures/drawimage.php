<?php
	//注意！！保存的时候不要改编码方式为utf-8，浏览器会出错500服务器错误，浏览器无法解析
	//而ANSC则可以
	$width = 500;
	$height= 300;
	$image = imagecreatetruecolor($width,$height);
	$red = imagecolorallocate($image,255,255,0);
	$white = imagecolorallocate($image,255,255,255);
	imagestring($image,20,200,150,'I love you',$white);
	imagechar($image,5,200,25,'l',$red);
	header('content-type:image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
?>