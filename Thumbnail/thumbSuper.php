<?php
/**
 * 实现比thumbDemo.php更加普遍适用的，
 * 能根据文件类型自动转换函数类型，完成图片的缩放功能
 */
header('content-type:text/html;charset=utf-8');
$filename = 'thumb/JD.jpg';
$fileInfo = getimagesize($filename);
if($fileInfo){
	// var_dump($fileInfo);
	list($src_w,$src_h) = $fileInfo;
	$mime = $fileInfo['mime'];
}else{
	die('文件不是真实图片');
}
//image/jpg image/png image/gif,把斜杠换为createfrom就OK
$createFun = str_replace('/', 'createfrom', $mime);
//同理去掉斜杠
$outFun = str_replace('/', null, $mime);
//等比例缩放
$dst_w = 300;
$dst_h = 600;
//缩放比例
//以下七行是算法
$ratio_orig = $src_w/$src_h;
if($dst_w/$dst_h>$ratio_orig){
	$dst_w = $dst_h*$ratio_orig;
}
else{
	$dst_h = $dst_w/$ratio_orig;
}
//创建源画布资源和布标画布资源
// $src_image = imagecreatefromjpeg($filename);
$src_image = $createFun($filename);
$dst_image = imagecreatetruecolor($dst_w,$dst_h);

imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
// imagejpeg($dst_image,'test_thumb.jpg');
$outFun($dst_image,'thumb/test_thumb.jpg');
imagedestroy($src_image);
imagedestroy($dst_image);






?>