<?php
	// header("Set-Cookie: a=1");
	// header('Set-Cookie: b=2; expires='.gmdate('D, d M Y H:i:s \G\M\T', time()+3600));
	//expire是到期时间
	//GMT：Greenwich Mean Time格林尼治标准时间
	// header('Set-Cookie: c=3; expires='.gmdate('D, d M Y H:i:s \G\M\T', time()+3600).',domain=.phpfamily.org');
	// header('Set-Cookie: d=4; path=/');
	// header('Set-Cookie: e=5; secure');
	// header('Set-Cookie: f=6; httponly');
	header('Set-Cookie: mame=jeven; expires='.gmdate('',time()-1).',domain=.phpfamily.org; httponly; secure');
?>