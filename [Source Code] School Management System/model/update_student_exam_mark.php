<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_student_exam_mark")){
	
	$id=$_POST['id'];	
	
	$msg=0;//for alerts
	
	$my_index = $_POST['my_index'];
	$std_index = $_POST['std_index'];	
	$grade_id = $_POST['grade'];
	$exam_id = $_POST['exam_id'];
	$current_year=date('Y');

	for($i=0;$i<count($_POST['subject_id']);$i++){
	
		$subject_id = $_POST['subject_id'];
		$mark = $_POST['exam_mark'];
		
		
		$sql = "update student_exam set marks='".$mark[$i]."'  where exam_id='$exam_id' and subject_id='$subject_id[$i]' and index_number='$std_index'";
		
		if(mysqli_query($conn,$sql)){
			$msg=1;
			//MSK-000143-3 The record has been successfully inserted into the database.
		}else{
			$msg=2; 
			//MSK-000143-4 Connection problem.
		}
	}
		
header("Location: view/my_student_exam_marks.php?do=alert_from_update&msg=$msg&exam=$exam_id&current_year=$current_year&my_index=$my_index&grade=$grade_id");
}
?>