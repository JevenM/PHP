<?php
	$width = 200;
	$height = 50;
	$image = imagecreatetruecolor($width,$height);
	$white = imagecolorallocate($image,255,255,255);
	imagefilledrectangle($image,0,0,$width,$height,$white);
	function getRandColor($image){
		return $randcolor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	}	
	$string = join('',array_merge(range(0, 9),range('a','z'),range('A','Z')));
	$length = 4;
	$textWidth = imagefontwidth(28);
	$textHeight = imagefontheight(28);
	for($i=0;$i<$length;$i++){
		// $randcolor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		$randcolor = getRandColor($image);
		$size = mt_rand(20,28);
		$angle = mt_rand(-15,15);
		// $x = 20+40*$i;
		// $y = 30;
		$x = ($width/$length)*$i+$textWidth;
		$y = mt_rand($height/2,$height-$textHeight);
		$fontFile = 'tt0282m_.ttf';
		//str_shuffle()��������string���͵������ַ�
		$text = str_shuffle($string){0};
		imagettftext($image,$size,$angle,$x,$y,$randcolor,$fontFile,$text);
	}
	//添加干扰元素,�?
	for ($i=1; $i <= 50; $i++) { 
		imagesetpixel($image, mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
	}
	//绘制干扰元素，线�?
	for ($i=1; $i <=3 ; $i++) { 
		imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
	}
	//绘制干扰元素，圆�?
	// for ($i=1; $i <= 2 ; $i++) { 
	// 	imagearc($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width/2),mt_rand(0,$height/2),mt_rand(0,360),mt_rand(0,360),getRandColor($image));
	// }
	header('content-type:image/png');
	imagepng($image);
	imagedestroy($image);
?>