<?php

$dbhost = 'localhost:3306';  // mysql服务器主机地址
$dbuser = 'root';            // mysql用户名
$dbpass = '1234';          // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_query($conn,"set names utf8");
if(! $conn )
{
    die('Could not connect: ' . mysqli_error());
}
echo '连接成功！';
mysqli_close($conn);
?>