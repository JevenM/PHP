<?php
	//ע�⣡�������ʱ��Ҫ�ı��뷽ʽΪutf-8������������500����������������޷�����
	//��ANSC�����
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