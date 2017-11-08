<?php
$filename = 'thumb/JD.jpg';
// $filename = 'timg.gif';
//获取图片大小信息
$fileInfo = getimagesize($filename);
//前两个参数
list($src_w,$src_h) = $fileInfo;
//目的图片长宽
$dst_w = 800;
$dst_h = 800;
//创建目的图像画布
$dst_image = imagecreatetruecolor($dst_w, $dst_h);
//通过图片文件创建源图像画布
// $src_image = imagecreatefromgif($filename);
$src_image = imagecreatefromjpeg($filename);
//把原图像按像素点一个一个拷贝到目的图像
imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
//生成并保存图片
imagejpeg($dst_image,'thumb/themb_100x100.jpg');
// imagegif($dst_image,'themb_100x100.gif');
imagedestroy($src_image);
imagedestroy($dst_image);
?>