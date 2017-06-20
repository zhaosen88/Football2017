<?php
	header("Content-Type: text/html; charset=UTF-8");
include 'templet.php';

//获取数据
//case 表
	// case 0 后台登录判断
	// case 1 后台管理员获取列表
	// case 2 修改管理员个人信息
    // case 3 修改管理员个人密码
	// case 4 添加管理员
	// case 5 后台用户获取列表
	// case 6 修改用户信息
	// case 7 课程管理--视频列表
	// case 8 课程管理--文档列表
	// case 9 题库管理--选择题列表
	// case 10 题库管理--判断题列表
	// case 11 题库管理--简答题列表
	// case 12 删除操作
	// case 13 添加课程
	// case 14 添加题目
	// case 15 获取修改课程
	// case 16 修改课程
	// case 17 获取修改选择题	
	// case 18 获取修改选择题
	// case 19 获取修改选择题
	// case 20 修改题库
	// case 21 获取题目ID
	// case 22 获取需要组卷的题目
if(@$_POST['case']==0){
	$user = @$_POST['username'];
	$pwd = @$_POST['password'];
	$result = mysqli_query($con,"SELECT managername password FROM ftr_managers where (managername = '$user' and password ='$pwd')");

	if($result){
		$row = mysqli_fetch_array($result);
		if($row){
		 	echo "登录成功<br>";
		}else{
		echo "管理员不存在<br>";
		}	 
	}
}

if(@$_POST['case']==1){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM ftr_managers order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
	echo "<tr><td><span>".$row['id']."</span></td><td>".$row['managername']."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['date']."</td><td>
	<a href='' class='del'>删除</a></td></tr>";
	}
}

if(@$_POST['case']==2){

	$a = @$_POST['username'];
	$b = @$_POST['name'];
	$c = @$_POST['email'];
	$time = date("Y-m-d H:i:s");
	$sql = mysqli_query($con,"UPDATE ftr_managers SET managername = '$a',name = '$b',email='$c',date='$time'
WHERE id = 1");
	 echo $a.$b.$c.$time;
}

if(@$_POST['case']==3){
	$a = @$_POST['username'];
	$b = @$_POST['password'];
	$c = @$_POST['newPassword'];
	$time = date("Y-m-d H:i:s");
	$sql = mysqli_query($con,"UPDATE ftr_managers SET password = '$c',date = '$time' WHERE (managername = '$a'and password='$b')");
	echo $a,$b,$c;
}

if(@$_POST['case']==4){
	$a = @$_POST['username'];
	$b = @$_POST['password'];
	$c = @$_POST['name'];
	$d = @$_POST['email'];
	$time = date("Y-m-d H:i:s");
	$sql = mysqli_query($con,"INSERT INTO ftr_managers (managername,password,name,email,date) 
VALUES ('$a','$b','$c','$d','$time')");
	if($sql){
	 	echo "OK";
	 }
	 else{
	 	echo "shibai";
	 }
}

if(@$_POST['case']==5){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM ftr_users order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['username']."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['date']."</td><td>
		<a href='' class='del' >删除</a></td></tr>";
	}

}

if(@$_POST['case']==6){
	$a = @$_POST['id'];
	$b = @$_POST['username'];
	$c = @$_POST['name'];
	$d = @$_POST['email'];
	$time = date("Y-m-d H:i:s");
	echo $a.$b.$c.$d;
	$sql = mysqli_query($con,"UPDATE ftr_users SET username = '$b',name = '$c',email='$d',date='$time'
	WHERE id = $a");
}

if(@$_POST['case']==7){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM course where type='video' order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['name']."</td><td>".$row['author']."</td><td>".$row['des']."</td><td>".$row['time']."</td><td>
		<a href='' class='del' >删除</a>&nbsp&nbsp<a href='course_edit.html?id=".$row['id']."' class='edit' >修改</a></td></tr>";
	}
}

if(@$_POST['case']==8){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM course where type='txt' order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['name']."</td><td>".$row['author']."</td><td>".$row['des']."</td><td>".$row['time']."</td><td>
		<a href='' class='del' >删除</a>&nbsp&nbsp<a href='course_edit.html?id=".$row['id']."' class='edit' >修改</a></td></tr>";
	}
}

if(@$_POST['case']==9){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM question_option order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td>".$row['optA']."</td><td>".$row['optB']."</td><td>".$row['optC']."</td><td>".$row['optD']."</td><td>".$row['answer']."</td><td>
		<a href='' class='del' >删除</a>&nbsp&nbsp<a href='question_edit.html?id=".$row['id']."&&case=17'class='edit' >修改</a></td></tr>";
	}
}

if(@$_POST['case']==10){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM question_judge order by id desc limit $num1,$num2 ");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td>".$row['answer']."</td><td>
		<a href='' class='del' >删除</a>&nbsp&nbsp<a href='question_edit.html?id=".$row['id']."&&case=18'class='edit' >修改</a></td></tr>";
	}
}

if(@$_POST['case']==11){
	$num1 = @$_POST['num1'];
	$num2 = @$_POST['num2'];
	$result = mysqli_query($con,"SELECT * FROM question_answer order by id desc limit $num1,$num2");
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td>".$row['answer']."</td><td>
		<a href='' class='del' >删除</a>&nbsp&nbsp<a href='question_edit.html?id=".$row['id']."&&case=19' class='edit' >修改</a></td></tr>";
	}
}

if(@$_POST['case']==12){
	$id = @$_POST['id'];
	$num = @$_POST['num'];
	$table = @$_POST['table'];
	$result = mysqli_query($con,"DELETE  FROM $table where id='$id' ");	
}

if(@$_POST['case']==13){
	$id = @$_POST['id'];
	$a = @$_POST['name'];
	$b = @$_POST['author'];
	$c = @$_POST['authorDes'];
	$d = @$_POST['authorPic'];
	$e = @$_POST['des'];
	$f = @$_POST['num'];
	$g = @$_POST['time'];
	$h = @$_POST['img'];
	$i = @$_POST['content'];
	$j = @$_POST['type'];
	$sql = mysqli_query($con,"INSERT INTO course (name,author,authorDes,authorPic,des,num,time,img,content,type)values('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')");
}

if(@$_POST['case']==14){
	$a = @$_POST['question'];
	$b = @$_POST['answer'];
	$c = @$_POST['optA'];
	$d = @$_POST['optB'];
	$e = @$_POST['optC'];
	$f = @$_POST['optD'];
	$g = @$_POST['type'];
	echo $a;
	if($g == "option"){
			$sql = mysqli_query($con,"INSERT INTO question_option (question,answer,optA,optB,optC,optD,type)VALUES('$a','$b','$c','$d','$e','$f','$g')");
	}
	if($g == "judge"){
			$sql = mysqli_query($con,"INSERT INTO question_judge (question,answer)VALUES('$a','$b')");
	}
	if($g == "answer"){
			$sql = mysqli_query($con,"INSERT INTO question_answer (question,answer)VALUES('$a','$b')");
	}

}
if(@$_POST['case']==15){
	$id = @$_POST['id'];
	$result = mysqli_query($con,"SELECT * FROM course where id = $id");
	while ($row = mysqli_fetch_array($result)) {
		echo $row['name']."|".$row['author']."|".$row['authorDes']."|".$row['authorPic']."|".$row['des']."|".$row['num']."|".$row['time']."|".$row['img']."|".$row['content']."|".$row['type']."|";
	}

}

if(@$_POST['case']==16){
	$id = @$_POST['id'];
	$a = @$_POST['name'];
	$b = @$_POST['author'];
	$c = @$_POST['authorDes'];
	$d = @$_POST['authorPic'];
	$e = @$_POST['des'];
	$f = @$_POST['num'];
	$g = @$_POST['time'];
	$h = @$_POST['img'];
	$i = @$_POST['content'];
	$j = @$_POST['type'];
	echo $g;
	
    $sql = mysqli_query($con,"UPDATE course set name='$a',author='$b',authorDes='$c',authorPic='$d',des='$e',num='$f',time='$g',img='$h',content='$i',type='$j' where id= $id");
	if($sql){
		echo "chenggong";
	}
	else{
		echo "shibai";
	}	
}

if(@$_POST['case']==17){
	$id = @$_POST['id'];
	$result = mysqli_query($con,"SELECT * FROM question_option where id='$id'");
	while ($row = mysqli_fetch_array($result)) {
		echo $row['question'].'|'.$row['optA'].'|'.$row['optB'].'|'.$row['optC'].'|'.$row['optD'].'|'.$row['answer'].'|';
	}
}

if(@$_POST['case']==18){
	$id = @$_POST['id'];
	$result = mysqli_query($con,"SELECT * FROM question_judge where id='$id' ");
	while ($row = mysqli_fetch_array($result)) {
		echo $row['question'].'|'.$row['answer'].'|';

	}
}

if(@$_POST['case']==19){
	$id = @$_POST['id'];
	$result = mysqli_query($con,"SELECT * FROM question_answer where id='$id'");
	while ($row = mysqli_fetch_array($result)) {
		echo $row['question'].'|'.$row['answer'].'|';
	}
}

if(@$_POST['case']==20){
	$id = @$_POST['id'];
	$a = @$_POST['question'];
	$b = @$_POST['answer'];
	$c = @$_POST['optA'];
	$d = @$_POST['optB'];
	$e = @$_POST['optC'];
	$f = @$_POST['optD'];
	$g = @$_POST['type'];
	if($g == "option"){
			$sql = mysqli_query($con,"UPDATE question_option set question='$a',answer='$b',optA='$c',optB='$d',optC='$e',optD='$f'where id='$id'");
	}
	if($g == "judge"){
			$sql = mysqli_query($con,"UPDATE question_judge set question='$a',answer='$b'where id='$id'");
	}
	if($g == "answer"){
			$sql = mysqli_query($con,"UPDATE question_answer set question='$a',answer='$b'where id='$id'");
	}

}
if(@$_POST['case']==21){
	$result1 = mysqli_query($con,"SELECT id FROM question_option ");
	while ($row = mysqli_fetch_array($result1)) {
		echo $row['id'];
	}
	echo '|';
	$result2 = mysqli_query($con,"SELECT id FROM question_judge ");
	while ($row = mysqli_fetch_array($result2)) {
		echo $row['id'];
	}
	echo '|';
	$result3 = mysqli_query($con,"SELECT id FROM question_answer ");
	while ($row = mysqli_fetch_array($result3)) {
		echo $row['id'];
	}
}
if(@$_POST['case']==22){
	$arr1 = @$_POST['arrOption'];
	$arr2 = @$_POST['arrJudge'];
	$arr3 = @$_POST['arrAnswer'];

	$num1 = sizeof($arr1);
	$num2 = sizeof($arr2);
	$num3 = sizeof($arr3);
	echo"<tr><td style='background-color:red'>选择题</td></tr>";
	for($i=0;$i<$num1;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_option where id='$arr1[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		//echo $row['id'].$row['question'].$row['optA'].$row['optB'].$row['optC'].$row['optD'].$row['answer'];
		//echo $row['id'];
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td>".$row['optA'].'<br>'.$row['optB'].'<br>'.$row['optC'].'<br>'.$row['optD']."</td><td>".$row['answer']."</td><td>
		</td></tr>";
		}		
	}
	echo"<tr><td style='background-color:red'>判断题</td></tr>";
	for($i=0;$i<$num2;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_judge where id='$arr2[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		//echo $row['id'];
		//echo $row['id'].$row['question'].$row['answer'];
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td></td><td>".$row['answer']."</td><td>
		</td></tr>";
		}		
	}
	echo"<tr><td style='background-color:red'>简答题</td></tr>";
	for($i=0;$i<$num3;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_answer where id='$arr3[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		//echo $row['id'];
		//echo $row['id'].$row['question'].$row['answer'];
		echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td></td><td>".$row['answer']."</td><td>
		</td></tr>";
		}		
	}
}
mysqli_close($con);
?>