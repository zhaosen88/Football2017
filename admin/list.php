<?php
	header("Content-Type: text/html; charset=UTF-8");
include 'templet.php';

//获取数据
//case 表
	// case 0 index.html 幻灯片
	// case 1 index.html 缩略大图
	// case 2 index.html 缩略小图
    // case 3 course.html 课程页
    //文档页 传入ID 是之前点击的课程ID case4
	//视频页 传入ID 是之前点击的课程ID case5
	//组卷页 根据ID选择选择表的数据 case6
	// case 7 获取题目ID
	// case 8 获取需要组卷的题目
//查询所有
if(@$_GET['case']==0){
	// $id = @$_GET['id'];
	$result = mysqli_query($con,"SELECT * FROM carousel  order by id asc limit 0,3");

	while ($row = mysqli_fetch_array($result)) {
		echo $row["url"].'|'.$row["name"].'|'.$row["des"].'|';
	}
}

if(@$_GET['case']==1){
	// $id = @$_GET['id'];
	$result = mysqli_query($con,"SELECT * FROM main_course");
	$table = "main_course";
	while ($row = mysqli_fetch_array($result)) {

	echo '<a href="course.html?id='.$row["id"].'&&table='.$table.'"class="picBigA">
                        <span class="picBigSpan">
                            <img class="imgBig" src="'.$row["img"].'" style="display: block;"/>
                            <span class="imgText">'.$row["name"].'</span>
                        </span>
                        <span class="picBigSpanF" style="color: #666;">'.$row["author"].'</span>
                        <span class="picBigSpanS">'.$row["des"].'</span>
                    </a>|';
	}
}

if(@$_GET['case']==2){
	// $id = @$_GET['id'];
	$result = mysqli_query($con,"SELECT * FROM course order by id asc limit 0,6");
	$table = "course";
	while ($row = mysqli_fetch_array($result)) {

		echo '<a href="course.html?id='.$row["id"].'&&table='.$table.'" class="picSmallA left">
                    	<span class="picSmallSpan">
                    		<img class="imgSmall" src="'.$row["img"].'" style="display: block;"/>
                    		<span class="imgTextSmall">'.$row["name"].'</span>
                    	</span>
                    	<span class="picSmallSpanF">'.$row["author"].'</span>
                    	<span class="picSmallSpanS">'.$row["des"].'</span>
                    </a>';
	}
}

if(@$_GET['case']==3){
	$id = @$_GET['id'];
	$table = @$_GET['table'];
	if($table == "course")
	$result = mysqli_query($con,"SELECT * FROM course where id = $id");
	if($table == "main_course")
	$result = mysqli_query($con,"SELECT * FROM main_course where id = $id");
	while ($row = mysqli_fetch_array($result)) {
	echo'<h2>'.$row["name"].'</h2>
					<p style="padding-top: 10px;">本课程共'.$row["num"].'集,欢迎学习</p>
					<span class="blank"></span>
					<p>课程介绍</p>
					<p>'.$row["des"].'</p>
					<a href="'.$row["type"].'.html?id='.$row["id"].'&&table='.$table.'" class="plybtn"></a>';

	echo'|<div class="CDown1">
								<a href="'.$row["type"].'.html?id='.$row["id"].'&&table='.$table.'"><span class="CD1Span0">'.$row["id"].'</span>
								<span class="CD1Span1">'.$row["name"].'</span>
								<span class="CD1Span2">▷ '.$row["time"].'</span></a>
								
							</div>';
	echo'|'.$row["author"];
	echo'|'.$row["authorDes"];
	}
}

//文档页 传入ID 是之前点击的课程ID case4
if(@$_GET['case']==4){
	$id = @$_GET['id'];
	$table = @$_GET['table'];
	$result = mysqli_query($con,"SELECT * FROM $table where id=$id");

	while ($row = mysqli_fetch_array($result)) {
	echo '<iframe src="'.$row["content"].'">
							
						</iframe>';
	echo '|'.$row["img"].'|'.$row["name"].'|'.$row["des"];
	}
}

//视频页 传入ID 是之前点击的课程ID case5
if(@$_GET['case']==5){
	$id = @$_GET['id'];
	$table = @$_GET['table'];
	$result = mysqli_query($con,"SELECT * FROM $table where id=$id");

	while ($row = mysqli_fetch_array($result)) {
	echo '<video src="'.$row["content"].'" autoplay preload="auto" controls height="485px" width="860px"></video>';
	echo '|'.$row["img"].'|'.$row["name"].'|'.$row["des"];
	}
}

//组卷页 根据ID选择选择表的数据 case6
if(@$_GET['case']==6){
	$num = @$_GET['num'];//题数
	$table = @$_GET['table'];
	if($table =="question_option"){
		$result = mysqli_query($con,"SELECT * FROM $table order by id asc limit 0,$num ");
		while ($row = mysqli_fetch_array($result)) {
		echo $row["question"].'|'.$row["optA"].'|'.$row["optB"].'|'.$row["optC"].'|'.$row["optD"].'|'.$row["answer"].'|';
		}
	}
	if($table =="question_judge"){
		$result = mysqli_query($con,"SELECT * FROM $table order by id asc limit 0,$num ");
		while ($row = mysqli_fetch_array($result)) {
		echo $row["question"].'|'.$row["answer"].'|';
		}
	}
	if($table =="question_answer"){
		$result = mysqli_query($con,"SELECT * FROM $table order by id asc limit 0,$num ");
		while ($row = mysqli_fetch_array($result)) {
		echo $row["question"].'|'.$row["answer"].'|';
		}
	}
	
}

if(@$_GET['case']==7){
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
if(@$_GET['case']==8){
	$str1 = @$_GET['strOption'];
	$str2 = @$_GET['strJudge'];
	$str3 = @$_GET['strAnswer'];
	echo $str1;
	$sql = mysqli_query($con,"INSERT INTO auto_test (option,judge,answer)VALUES('1','2','3')");
	// $sql = mysqli_query($con,"INSERT INTO auto_test (option) VALUES ('123')");
	if($sql){
		echo "OK";
	}
	else{
		echo "shibai";
	}
	
	$arr1 = @$_GET['arrOption'];
	$arr2 = @$_GET['arrJudge'];
	$arr3 = @$_GET['arrAnswer'];


	$num1 = sizeof($arr1);
	$num2 = sizeof($arr2);
	$num3 = sizeof($arr3);
	//echo"<tr><td style='background-color:red'>选择题</td></tr>";
	for($i=0;$i<$num1;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_option where id='$arr1[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		echo $row["question"].'|'.$row["optA"].'|'.$row["optB"].'|'.$row["optC"].'|'.$row["optD"].'|'.$row["answer"].'|';
		}
		//echo $row['id'];
		// echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td>".$row['optA'].'<br>'.$row['optB'].'<br>'.$row['optC'].'<br>'.$row['optD']."</td><td>".$row['answer']."</td><td>
		// </td></tr>";
		}		
	
	//echo"<tr><td style='background-color:red'>判断题</td></tr>";
	for($i=0;$i<$num2;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_judge where id='$arr2[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		//echo $row['id'];
		//echo $row['id'].$row['question'].$row['answer'];
		echo $row["question"].'|'.$row["answer"].'|';
		//echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td></td><td>".$row['answer']."</td><td>
		//</td></tr>";
		}		
	}
	//echo"<tr><td style='background-color:red'>简答题</td></tr>";
	for($i=0;$i<$num3;$i++){
		$result = mysqli_query($con,"SELECT * FROM question_answer where id='$arr3[$i]'");
		while ($row = mysqli_fetch_array($result)) {
		//echo $row['id'];
	////echo $row['id'].$row['question'].$row['answer'];
		//echo "<tr><td><span>".$row['id']."</span></td><td>".$row['question']."</td><td></td><td>".$row['answer']."</td><td>
		//</td></tr>";
		}		
	}
}
if(@$_GET['case']==9){
	$str1 = @$_GET['strOption'];
	$str2 = @$_GET['strJudge'];
	$str3 = @$_GET['strAnswer'];
}
mysqli_close($con);
?>