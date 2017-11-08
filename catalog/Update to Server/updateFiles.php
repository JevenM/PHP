<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>上传文件</title>
</head>
<body>
	<form action="RecvFile.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		上传文件：<input type="file" name="userfile" />
		<input type="submit" name="shangchuan" value="上传">
	</form>
</body>
</html>
<?php  ?>