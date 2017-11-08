<?php 
	//userInfo这个数组里面存放了三个元素，username、email、password
	setcookie('userInfo[username]','jeven',strtotime('+ 7 days'));//7天后到期
	setcookie('userInfo[email]','2446026601@qq.com',strtotime('+ 7 days'));
	setcookie('userInfo[password]','123456',strtotime('+ 10 mins'));//10分钟过后cookie过期
?>