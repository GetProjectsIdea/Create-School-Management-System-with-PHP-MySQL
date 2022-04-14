<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_student_exam_mark2")){
	
	$std_index = $_POST['std_index'];	
	$grade_id = $_POST['grade'];
	$exam_id = $_POST['exam_id'];
	$current_year=date('Y');
	$msg=0;//for alerts
	for($i=0;$i<count($_POST['subject_id']);$i++){
	
		$subject_id = $_POST['subject_id'];
		$mark = $_POST['exam_mark'];
		$id=$_POST['id'];
		
		$sql = "update student_exam set marks='".$mark[$i]."'  where id='$id[$i]'";
		
		if(mysqli_query($conn,$sql)){
			$msg+=1;
			//MSK-000143-3 The record has been successfully inserted into the database.
		}else{
			$msg+=-1; 
			//MSK-000143-4 Connection problem.
		}
	}

	header("Location: view/student_exam_marks.php?do=show_student&exam=$exam_id&current_year=$current_year&grade=$grade_id&msg=$msg");
}
?>