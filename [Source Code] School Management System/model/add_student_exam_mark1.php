<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_student_exam_mark1")){
	
	$std_index = $_POST['std_index'];	
	$grade_id = $_POST['grade'];
	$exam_id = $_POST['exam_id'];
	$page = $_POST['current_page'];
	
	$current_year=date('Y');
	$date=date("Y-m-d");
	$msg=0;//for alerts

	for($i=0;$i<count($_POST['subject_id']);$i++){
	
		$subject_id = $_POST['subject_id'];
		$mark = $_POST['exam_mark'];
		
		$sql = "INSERT INTO student_exam(index_number,grade_id,exam_id,subject_id,marks,year,date)
				VALUES ('".$std_index."','".$grade_id."','".$exam_id."','".$subject_id[$i]."','".$mark[$i]."','".$current_year."','".$date."')";
				
		if(mysqli_query($conn,$sql)){
			$msg+=1;
			//MSK-000143-3 The record has been successfully inserted into the database.
		}else{
			$msg+=-1; 
			//MSK-000143-4 Connection problem.
		}
		
	}

	header("Location: view/student_exam_marks.php?do=show_student_from_insert&msg=$msg&exam=$exam_id&current_year=$current_year&grade=$grade_id");		//MSK-000143-5

}
?>