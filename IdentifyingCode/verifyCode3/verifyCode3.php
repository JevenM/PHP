<?php
/**
 * 默认产生4位数字的验证码
 * @param  integer $type     [1：数字 2：字母 3：数字+字母 4：汉字]
 * @param  integer $length   [验证码长度]
 * @param  integer $arc      [干扰弧线]
 * @param  integer $line     [干扰线段]
 * @param  integer $width    [画布宽度]
 * @param  integer $height   [画布高度]
 * @param  integer $pixel    [干扰像素点]
 * @param  string  $fontFile [字体文件]
 * @param  string  $codeName [存入session的名字]
 * @return void            
 */
function getRandColor($image){
		return $randcolor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	}	
function getVerify($type=3,$length=4,$arc = 1,$line = 2,$width = 200,$height = 50,$codeName='verifyCode',$pixel = 50,$fontFile = 'tt0375m_.ttf'){
	
	$image = imagecreatetruecolor($width,$height);
	$white = imagecolorallocate($image,255,255,255);
	imagefilledrectangle($image,0,0,$width,$height,$white);
	
	// $type = 2;
	// $length = 4;
	switch ($type) {
		case 1:
		//数字
			$string = join('',array_rand(range(0, 9),$length));
			//array_rand()随机返回几个数组的键名
			//echo $string;
			break;
		
		case 2:
		//字母
			$string = join('',array_rand(array_flip(array_merge(range('a','z'),range('A','Z'))),$length));
			//array_flip()将数组键名和键值反转后返回
			// print_r($arr);
			break;
		
		case 3:
		//数字加字母
			$string = join('',array_rand(array_flip(array_merge(range(0,9),range('a','z'),range('A','Z'))),$length));
			//echo $string;
			break;
		
		case 4:
		//汉字
			$str = "如,同,定,时,炸,弹,一,般,彻,底,掀,翻,娱,乐,圈,当,红,女,星,姚,笛,被,拍,到,与,有,家,室,的,人,气,高,涨,男,在,起,挽,手,逛,街,而,此,时,妻,子,马,司,令,才,刚,生,完,女,儿,时,间,文,章,和,姚,笛,被,媒,体,推,到,了,风,口,浪,尖,如,今,隔,三,年";
			$arr = explode(',', $str);
			//按','分割字符串
			$string = join('',array_rand(array_flip($arr),$length));
			break;
		
		default:
			exit("非法参数");
			break;
	}
	//将验证码存入session
	if (!session_id()) {
    	session_start();
	}
	$_SESSION[$codeName] = $string;
    
	for ($i=0; $i < $length; $i++) { 
		$size = mt_rand(18,25);
		$angle = mt_rand(-15,15);
		$x = 20+($width/$length)*$i;
		$y = mt_rand(ceil($height/2),$height-10);
		$color = getRandColor($image);
		$text = mb_substr($string, $i,1,'utf-8');//不知道为什么mb_substr()函数不能用
		imagettftext($image,$size,$angle,$x,$y,$color,$fontFile,$text);
	}

	// $pixel = 50;
	// $arc = 2;
	// $line = 3;
	//添加干扰元素
	if($pixel>0){
		for($i=0;$i<$pixel;$i++){
			imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
		}
	}
	//添加线段干扰元素
	if($line>0){
		for($i=0;$i<$line;$i++){
			imageline($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),getRandColor($image));
		}
	}
	//添加弧线干扰元素
	if($arc>0){
		for($i=0;$i<$arc;$i++){
			imagearc($image,mt_rand(0,$width/2),mt_rand(0,$height/2),mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,360),mt_rand(0,360),getRandColor($image));
		}
	}

	header('content-type:image/png');
	imagepng($image);
	imagedestroy($image);
}
//调用函数
// getVerify(3,5,2,1,200);
getVerify();
?>