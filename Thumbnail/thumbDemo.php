<?php
/**
 * 比较死，每个图片类型都对应单独一种函数，如imagejpeg()
 * imagecreatefromjpeg()等
 */
header('content-type:text/html;charset=utf-8');
$filename = 'thumb/JD.jpg';
$fileInfo = getimagesize($filename);
if($fileInfo){
	list($src_w,$src_h) = $fileInfo;
}else{
	die('文件不是真实图片');
}
//等比例缩放
$dst_w = 300;
$dst_h = 600;
//缩放比例
$ratio_orig = $src_w/$src_h;
if($dst_w/$dst_h>$ratio_orig){
	$dst_w = $dst_h*$ratio_orig;
}
else{
	$dst_h = $dst_w/$ratio_orig;
}
//创建源画布资源和布标画布资源
$src_image = imagecreatefromjpeg($filename);
$dst_image = imagecreatetruecolor($dst_w,$dst_h);

imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
imagejpeg($dst_image,'thumb/thumb_300x300.jpg');
imagedestroy($src_image);
imagedestroy($dst_image);






?>