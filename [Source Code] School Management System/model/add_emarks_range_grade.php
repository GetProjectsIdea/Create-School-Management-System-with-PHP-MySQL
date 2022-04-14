<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_emarks_range_grade")){
	
$grade_id = $_POST['grade_id'];
$msg=0;//for alerts

	for($i=0;$i<count(($_POST['mark_range']));$i++){
	
		$mark_range = $_POST['mark_range'];
		$mark_grade = $_POST['mark_grade'];
		
		$m_range=(explode("-",$mark_range[$i]));
		
		$_from=$m_range[0];
		$_to=$m_range[1];
		
		$sql = "INSERT INTO exam_range_grade(grade_id,mark_range,_from,_to,mark_grade)
				VALUES ('".$grade_id."','".$mark_range[$i]."','".$_from."','".$_to."','".$mark_grade[$i]."')";
				
		if(mysqli_query($conn,$sql)){
			$msg=5;
			//MSK-000143-3 The record has been successfully inserted into the database.
		}else{
			$msg=3; 
			//MSK-000143-4 Connection problem.
		}
		
	}
	
	if($_POST["current_page"]== NULL){
		header("Location: view/grade.php?do=alert_from_insert&msg=$msg&grade=$grade_id");//MSK-000143-5
		
	}else{
		$page=$_POST["current_page"];
		header("Location: view/grade.php?do=alert_from_eMark_insert&msg=$msg&grade=$grade_id&page=$page");//MSK-000143-6
	}
	
}
?>