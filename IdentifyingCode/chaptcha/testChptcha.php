<?php
	/**
	 * 配置文件
	 */
	require_once 'captcha.class.php'; 
	$config = array(
		'fontfile'=>'tt0375m_.ttf',
		'snow'=>0,
		'pixel'=>30,
		'line'=>2
		);
	$captcha = new Captcha($config);
	session_start();
	$_SESSION['verifyName'] = $captcha->getCaptcha();
?>