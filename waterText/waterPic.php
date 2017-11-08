<?php
/**
 * 图片水印
 * @var string
 */
$logo = 'jd.png';
$filename = '1.jpg';
$dst_im = imagecreatefromjpeg($filename);
$src_im = imagecreatefrompng($logo);
//把一张图片当做水印到另一张图片上。最后一个参数：透明度
imagecopymerge($dst_im, $src_im, 30,160,0,0, 148, 74, 80);
//目的图片起始坐标，原图片起始坐标，原图片本身的像素宽高，透明度
header('content-type:image/jpeg');
imagejpeg($dst_im);
imagedestroy($src_im);
imagedestroy($dst_im);
?>