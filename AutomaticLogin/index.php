 <?php
 	if(!isset($_COOKIE['username']) || !isset($_COOKIE['auth'])){
 		exit("<script>
			alert("登录之后再访问!");
			location.href = 'login.php';
			</script>");
 	}
 	//校验用户登录凭证
 	if(isset($_COOKIE['auth'])){

	 	$auth = $_COOKIE['auth'];
	 	$resArr = explode(';', $auth);
	 	$userId = end($resArr);
	 	$link = mysqli_connect('localhost','root','1234') or die('Error Connect!');
		mysqli_set_charset($link, 'utf8');
		mysqli_select_db($link, 'login') or die('Database Open Error!');
		$sql = "SELECT id, username, password FROM user WHERE id=$userId";
		$result = mysqli_query($link, $sql);
		if($rowCount = mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			$username = $row['username'];
			$password = $row['password'];
			$salt = 'jeven';
			$authStr = md5($username.$password.$salt);
			if($authStr!=$resArr[0]){
				exit("<script>
				alert("登录之后再访问!");
				location.href = 'login.php';
				</script>");
			}
		}
		else{

		}
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8" />
 	<title>首页</title>
 	<style type="text/css">
 		body{
			background: #f5f5f5;
 		}
		*{
			padding: 0;
			margin: 0;
		}
		h1{
			font-size: 30px;
			font-family: 'weiruanyahei';
			margin-top: 10px;
			margin-left: 10px;
			font-weight: normal;
		}
		#navbar{
			margin: 10px auto;
			width: 100%;
			height: 80px;
			background: #606060;
			/*border-radius: 5px;*/
			box-shadow: 2px 2px 2px #d3d3d3;
		}
		.nav{
			height: 80px;
			width: 600px;
			margin: 0 auto;
			font-size: 20px;
		}
		.nav li{
			line-height: 80px;
			list-style: none;
			float: left;
			margin: 0 10px;
			padding: 0 10px;
			color: #FFC0CB;
		}
		.nav li a{
			color: #fff;
			text-decoration: none;
		}
		.active{
			color: white;
			background: #1E90FF;
		}
		.active:hover{
			cursor: pointer;
		}
		.nav li:hover{
			cursor: pointer;
			background: #1E90FF;
		}
		.nav #none:hover{
			background: none;
		}
 	</style>
 </head>
 <body>
 <h1>我的首页</h1>
 <div id="navbar">
 	<ul class="nav">
		<li class="active"><a href="">首页</a></li>
		<li><a href="">热门文章</a></li>
		<li><a href="">尖端技术</a></li>
		<li><a href="">最新产品</a></li>
		<li id="none"><i>欢迎您，</i><?php echo $_COOKIE['username']; ?></li>
 	</ul>
 </div>
 </body>
 </html>