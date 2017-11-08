<?php
$filename = '1.jpg';
$fileInfo = getimagesize($filename);
// var_dump($fileInfo);
$mime = $fileInfo['mime'];
$img_w = $fileInfo[0]/2;
$img_h = $fileInfo[1]/2;
$createFun = str_replace('/', 'createfrom', $mime);
$outFun = str_replace('/', null, $mime);
$image = $createFun($filename);
// $red = imagecolorallocate($image, 255, 0, 0);
// 带透明度的文字颜色
$red = imagecolorallocatealpha($image, 255, 0, 0, 65);
$fontfile = 'tt0282m_.ttf';
$fontsize = 30;
$font_width = imagefontwidth(30)*6;
imagettftext($image, $fontsize, 0, $img_w-$font_width, $img_h, $red, $fontfile, 'JD.COM');
header('content-type:'. $mime);
$outFun($image);
imagedestroy($image);
?>