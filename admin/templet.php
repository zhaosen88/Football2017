<?php 
//主机名
$db_host = 'localhost';
//用户名
$db_user = 'root';
//密码
$db_password = '';
//数据库名
$db_name = 'FTR';
//端口
$db_port = '3306';
 
//连接数据库
$con = mysqli_connect($db_host,$db_user,$db_password,$db_name) or die('连接数据库失败！');
  
?>