<?php 
	$current_dir = getcwd();//取得当前工作目录
	echo $current_dir;
	$dir = "d:\\php_exam1";
	$subdir = "d:\\php_exam1\\2014";
	mkdir($dir);//创建新的文件夹
	mkdir($subdir);
	$current_dir = getcwd();
	echo $current_dir;
	if(chdir($subdir)){//将目录切换到参数的目录中
		$current_dir = getcwd();
		echo "当前目录：".$current_dir;
	}
	//rmdir($subdir);删除空的文件夹出错
	// rmdir($dir);   PHP Warning: rmdir(d:\php_exam1\2014): Resource temporarily unavailable in D:\bbbbbbjjjjjj\php\myphp\目录操作\目录处理.php on line 14 
	//unlink($subdir);  PHP Warning: unlink(d:\php_exam1\2014): Permission denied in D:\bbbbbbjjjjjj\php\myphp\目录操作\目录处理.php on line 16 
?>