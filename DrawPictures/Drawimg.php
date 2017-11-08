<?php
	$image = imagecreatetruecolor(500,500);
	$white = imagecolorallocate($image,255,255,255);
	$randcolor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	imagefilledrectangle($image,0,0,500,500,$white);
	imagettftext($image,20,0,100,100,$randcolor,'tt0726m_.ttf','HELLO,WHIT\'S THE FUCK£¿');
	header('content-type:image/png');
	imagepng($image);
	imagedestroy($image);
?>