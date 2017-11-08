<?php
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$autoLogin = $_POST['autoLogin'];
	$link = mysqli_connect('localhost','root','1234') or die('Error Connect!');
	mysqli_query($link,"set names utf8");
	mysqli_select_db($link, 'login') or die('Database Open Error!');
	$sql = "SELECT id, username, password FROM user WHERE username='{$username}' && password='{$password}'";
	$sql = mysqli_escape_string($link, $sql);
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) == 1){
		if(autoLogin == 1){
			$row = mysqli_fetch_assoc($result);
			//获取关联数组
			setcookie('username',$username, strtotime('+ 7 days'));
			$salt = 'jeven';
			$auth = md5($username.$password.$salt).";".row['id'];
			setcookie('$auth',$auth,strtotime('+ 7 days'));
		}
		else{
			setcookie('username',$username);
		}
		exit("<script>alert();location.href = 'index.php';</script>");
	}
	else{
		exit("<script>
			alert('哈');
			location.href = 'login.php';
			</script>");
	}
?>