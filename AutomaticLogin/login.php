<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录注册表</title>
<style>
*{
	margin:0;
	padding:0;
}
.inner{
	margin:20px auto;
	width:190px;
	background-color:#d5f4f5;
	padding:10px 20px;
}
.tp{
	width:190px;
	height:30px;
	text-indent:20px;
}
input[type="password"]{
	margin-top:10px;
}
p{
	font-size:12px;
	margin-top:10px;
	overflow:hidden;
}
p input{
	vertical-align:top;
	margin-right:4px;
}
p a{
	text-decoration:none;
	float:right;
}
input[type="button"]{
	width:190px;
	height:37px;
	border:0;
	margin-top:15px;
	cursor:pointer;
}
#btn{
	width: 191.6px;
	height: 30px;
	display: block;
	margin: 10px auto;
}
</style>
</head>

<body>
    <div class="inner">
        <form method="post" action="doLogin.php">
            <input class="tp" name="username" type="text" placeholder="邮箱/手机号/用户名" />
            <input class="tp" name="password" type="password" placeholder="请输入密码" />
            <p>
                <input type="checkbox" name="autoLogin" value="1" />一周内自动登录<a href="javascript:;">忘记密码?</a>
            </p>
            <button id="btn" type="submit">立即登录</button>
        </form>
    </div>

</body>
</html>