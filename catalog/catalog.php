<?php 
	$dir = "d://";
	if(!is_dir($dir)){
		return;
	}
	echo '是有效目录<br >';
	if(!($dir_point = opendir($dir))){
		echo "打开目录失败";
	}
	if(!is_null($dir_point)){
		closedir($dir_point);
	}
	浏览目录树
	$dir_tree = scandir($dir);
	foreach ($dir_tree as $value) {
		if(is_dir($dir.$value)){
			echo "目录".$dir.$value;
		}
		else{
			if(is_file($dir.$value))
				echo "文件".$dir.$value;
		}
		echo '<br >';
	}
 ?>