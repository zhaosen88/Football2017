<?php
	header("Content-Type: text/html; charset=UTF-8");
// //连接
 $con = mysql_connect("localhost","root","");

// //检测连接
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else{
	echo"建立连接OK!<br>";
}

// //选择数据库
$myDb = mysql_select_db("FTR");
if($myDb){
	echo"数据库选择OK！<br>";
}

$a = @$_POST['username'];
$b = @$_POST['password'];
$c = @$_POST['name'];
$d = @$_POST['email'];
$time = date("Y-m-d H:i:s");
echo $a."<br>";
//查找数据
$result = mysql_query("SELECT username FROM ftr_users where username = '$a'");
if($result){
	$row = mysql_fetch_array($result);
	 echo $row;
	 echo "用户名已存在<br>";
}else{
	echo "用户名可用<br>";
}
//插入数据
if($a&&$b&&$c&&$d){
	$sql = mysql_query("INSERT INTO ftr_users (username,password,name,email,date) 
VALUES ('$a','$b','$c','$d','$time')");
	if($sql){
	echo "插入数据成功";
	}
}



mysql_close($con);

//返回html
echo "<a href='../index.html'>返回</a>";

?>