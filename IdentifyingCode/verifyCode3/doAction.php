<?php
	header('content-type:text/html;charset=utf-8');
	if (!session_id()) {
    	session_start();
	}
	print_r($_SESSION);
	echo "<hr>";
	print_r($_POST);
	
?>