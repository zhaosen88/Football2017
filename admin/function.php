<?php
function connect($ip="localhost",$username="root",$password="",$dbname="FTR"){
	//连接
	mysql_connect($ip,$username,$password);
	//检测连接
	if (!$con)
	  {
	  	die('Could not connect: ' . mysql_error());
	  }
	else{
		//echo"建立连接OK!<br>";
	}
	//选择数据库
	mysql_select_db($dbname);
}

function insert($prop,$table_name,$table_prop){
	//插入数据
	$proplength=count($prop);
	$proplength=count($prop);
	for($x=0;$x<$arrlength;$x++) {
  	mysql_query("INSERT INTO $table_name (txtname,txtsort,date,content) 
	VALUES ('','$b','$time','$c')");

}
	for()
	$time = date("Y-m-d H:i:s");
	echo $a;
	echo $b;
	echo $c;
	if($a&&$b&&$c){
		$sql = mysql_query("INSERT INTO $table_name (txtname,txtsort,date,content) 
	VALUES ('','$b','$time','$c')");

	mysql_query("INSERT INTO $table_name ($table_prop[0],txtsort,date,content) 
	VALUES ('','$b','$time','$c')");
	}
}
function close(){
	mysql_close($con);
}
?>