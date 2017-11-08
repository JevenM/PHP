<?php
	print_r($_FILES);
	echo '<br />';
	//文件类型检查
	//文件上传之前的检查
	if($_FILES['userfile']['error']>0){
		switch ($_FILES['userfile']['error']) {
			case 1:
				echo "上传的文件超过了php.ini中限制的值";
				break;
			case 2:
				echo "上传的文件大小超过了HTML表单中MAX_FILE_SIZE选项指定的值";
				break;
			case 3:
				echo "文件只有部分被上传";
				break;
			case 4:
				echo "没有文件被上传";
				break;
			case 5:
			case 6:
				echo "找不到临时的文件夹";
				break;
			case 7:
				echo "文件写入失败";
				break;
			
			default:
				echo "未知错误";
		}
		exit;
	}
	else{
		if($_FILES['userfile']['size']>1000000){
			echo "上传的文件大小超过了HTML表单中MAX_FILE_SIZE选项指定的值";
			exit;
		}
	}
	if($_FILES['userfile']['type']=='image/jpg' || $_FILES['userfile']['type'] == 'image/jpeg'){
		echo "上传的文件格式不正确";
		exit;
	}
	$recvDir = 'f:\\uploads';
	if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
		if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name'])){
			echo "<script>
				alert('文件移动失败');
				location.href = history.back(-1);
			</script>";
			exit;
		}
		else{
			echo "<br />";
			// echo "<script> location.href = 'show_file.php?url=".$recvDir."\\".$_FILES['userfile']['name']."'</script>";
			echo "<script> alert('文件上传成功');location.href = 'show_file.php?url=".$_FILES['userfile']['name']."';</script>";
			// echo "<script> location.href='proc.php?url=".$_FILES['userfile']['name']."'</script>";
		}
	}
	else{
		echo "<br />";
		echo "<script>alert('上传临时文件夹不存在');location.href = history.back(-1);</script>";
	}
?>