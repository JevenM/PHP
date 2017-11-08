<?php
	$width = 200;
	$height = 50;
	$image = imagecreatetruecolor($width,$height);
	$white = imagecolorallocate($image,250,250,250);
	imagefilledrectangle($image,0,0,$width,$height,$white);
	$randcolor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	$size = mt_rand(20,28);
	$angle = mt_rand(-15,15);
	$x = 50;
	$y = 30;
	$fontFile = 'tt0726m_.ttf';
	$text = mt_rand(1000,9999);
	imagettftext($image,$size,$angle,$x,$y,$randcolor,$fontFile,$text);
	header('content-type:image/png');
	imagepng($image);
	imagedestroy($image);
?>