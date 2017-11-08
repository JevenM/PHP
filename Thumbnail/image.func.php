<?php
/**
 * 指定缩放比例
 * 最大宽度和高度，等比例缩放
 * 可以对所放图文件添加前缀
 * 选择是否删除缩略图的源文件
 */
/**
 * 返回图片信息
 * @param  [string] $filename [文件名]
 * @return [array]  [包含图片长度，宽度，创建和出书的字符串以及扩展名]
 */
function getImageInfo($filename){
	if(@!$info = getimagesize($filename)){
		exit('文件不是真实图片');
	}
	$fileInfo['width'] = $info[0];
	$fileInfo['height'] = $info[1];
	$mime = image_type_to_mime_type($info[2]);
	$createFun = str_replace('/','createfrom',$mime);
	$outFun = str_replace('/','',$mime);
	$fileInfo['createFun'] = $createFun;
	$fileInfo['outFun'] = $outFun;
	//image_type_to_extension()函数获得后缀类型并在前面加上‘.’
	$fileInfo['ext'] = strtolower(image_type_to_extension($info[2]));
	return  $fileInfo;
}
/**
 * [形成缩略图的函数]
 * @param  [string] $filename [文件名]
 * @param  [type] $dst_w    [最大宽度]
 * @param  [type] $dst_h    [最大高度]
 * @param  float  $scale    [默认缩放比例]
 * @param  string $dest     [缩略图保存路径，默认为thumb下]
 * @param  string $pre      [默认前追尾thumb_]
 * @return [boolean] delSource [是否删除文件夹]
 * @return [type]           [最终保存路径及文件名]
 */
function thumb($filename,$dst_w=null,$dst_h=null,$scale=0.5,$dest = 'thumb',$pre = "thumb_",$delSource = false){
	// $filename = 'JD.jpg';
	// $scale = 0.5;
	//最大宽高
	// $dst_w = 200;
	// $dst_h = 300;
	// 保存目录文件夹
	// $dest = 'thumb';
	//默认前缀
	// $pre = "thumb_";
	//删除原文件？默认false
	// $delSource = false;
	//文件信息
	$fileInfo = getImageInfo($filename);
	$src_w = $fileInfo['width'];
	$src_h = $fileInfo['height'];
	//如果指定了最大宽度和高度，按照等比例缩放算法进行
	if (is_numeric($dst_w) && is_numeric($dst_h)) {
		$ratio_orig = $src_w/$src_h;
		if($dst_w/$dst_h>$ratio_orig){
			$dst_w = $dst_h*$ratio_orig;
		}
		else{
			$dst_h = $dst_w/$ratio_orig;
		}
	}//否则按照默认的缩放比例
	else{
		$dst_w = ceil($src_w*$scale);
		$dst_h = ceil($src_h*$scale);
	}
	$dst_image = imagecreatetruecolor($dst_w,$dst_h);
	$src_image = $fileInfo['createFun']($filename);
	imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
	//检测目标文件夹是否存在，不存在则创建
	if ($dest && !file_exists($dest)) {
		mkdir($dest,0777,true);
	}
	$randNum = mt_rand(100000,999999);
	//拼接文件名
	$destName = "{$pre}{$randNum}".$fileInfo['ext'];
	// echo $destName;
	$destination = $dest ? ( $dest . '/' . $destName ) : $destName;
	$fileInfo['outFun']($dst_image, $destination);
	imagedestroy($src_image);
	imagedestroy($dst_image);
	if($delSource){
		@unlink($filename);
	}
	return $destination;
}




/**
 * 文字水印
 * @param  [type]  $filename [description]
 * @param  [type]  $fontfile [description]
 * @param  string  $text     [description]
 * @param  string  $dest     [description]
 * @param  string  $pre      [description]
 * @param  string  $delSource[description]
 * @param  integer $r        [description]
 * @param  integer $g        [description]
 * @param  integer $b        [description]
 * @param  integer $alpha    [description]
 * @param  integer $size     [description]
 * @param  integer $angle    [description]
 * @param  integer $x        [description]
 * @param  integer $y        [description]
 * @return [type]            [description]
 */
function water_text($filename,$fontfile,$text = 'JD.COM',$dest='WaterText',$pre = 'waterText_',$delSource = false,$r = 255,$g = 0,$b = 0,$alpha = 60,$size = 30,$angle = 0,$x=0,$y=60){
	// $filename = '1.jpg';
	// $r = 255;
	// $g = 0;
	// $b = 0;
	// $alpha = 60;
	// $size = 30;
	// $angle = 30;
	// $fontfile = 'tt0282m_.ttf';
	// $text = '我爱科学';
	// $dest = 'WaterText';//文件夹
	// $pre = 'waterText_';//命名前缀
	$randNum = mt_rand(100000,999999);
	$fileInfo = getImageInfo($filename);
	$image = $fileInfo['createFun']($filename);
	$color = imagecolorallocatealpha($image, $r, $g, $b, $alpha);
	imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	
	if($dest && !file_exists($dest)){
		mkdir($dest,0777,true);
	}
	$dstName = "{$pre}{$randNum}".$fileInfo['ext'];
	$destination = $dest ? ($dest.'/'.$dstName) : $destName;
	$fileInfo['outFun']($image,$destination);
	imagedestroy($image);
	if($delSource){
		@unlink($filename);
	}
	return $destination;
}

function water_pic($dstName,$srcName,$pos=0,$dest='waterPic',$pre='Water_pic',$pct=65,$delSource=false){
	// $dstName = '1.jpg';
	// $srcName = 'jd.png';
	// $pos = 0;//位置序号
	// $pct = 50;
	// $dest = 'waterPic';
	// $pre = 'Water_pic';
	$dstInfo = getImageInfo($dstName);
	$srcInfo = getImageInfo($srcName);
	$src_im = $srcInfo['createFun']($srcName);
	$dst_im = $dstInfo['createFun']($dstName);
	$src_width = $srcInfo['width'];
	$dst_width = $dstInfo['width'];
	$src_height = $srcInfo['height'];
	$dst_height = $dstInfo['height'];
	switch ($pos) {
		case 0:
			$x=0;
			$y=0;
			break;
		case 1:
			$x=($dst_width-$src_width)/2;
			$y=0;
			break;
		case 2:
			$x=$dst_width-$src_width;
			$y=0;
			break;
		case 3:
			$x=0;
			$y=($dst_width-$src_width)/2;
			break;
		case 4:
			$x=($dst_width-$src_width)/2;
			$y=($dst_height-$src_height)/2;
			break;
		case 5:
			$x=($dst_width-$src_width);
			$y=($dst_height-$src_height)/2;
			break;	
		case 6:
			$x=0;
			$y=($dst_height-$src_height);
			break;	
		case 7:
			$x=($dst_width-$src_width)/2;
			$y=($dst_height-$src_height);
			break;
		case 8:
			$x=($dst_width-$src_width);
			$y=($dst_height-$src_height);
			break;
		default:
			$x=0;
			$y=0;
			break;
	}
	imagecopymerge($dst_im, $src_im, $x, $y, 0, 0, $src_width, $src_height, $pct);
	$randNum = mt_rand(1000,9999);
	if($dest && !file_exists($dest)){
		mkdir($dest,0777,true);
	}
	//命名为前缀+透明度$pct+随机数字+.JPEG/.png/.gif
	$dstName = "{$pre}{$pct}{$randNum}".$dstInfo['ext'];
	$destination = $dest ? ($dest.'/'.$dstName) : $destName;
	$dstInfo['outFun']($dst_im,$destination);
	imagedestroy($src_im);
	imagedestroy($dst_im);
	if($delSource){
		@unlink($filename);
	}
	return $destination;


}











