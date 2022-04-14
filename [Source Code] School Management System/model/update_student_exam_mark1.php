<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="update_student_exam_mark")){
	
	$id=$_GET['id'];	
	$mark= $_GET['mark'];
	$msg=0;//for alerts
	
	if(is_numeric($mark)){  
				
	}else{
		$mark="Absent";
	}
	
	$sql = "update student_exam set marks='".$mark."'  where id='$id'";

	if(mysqli_query($conn,$sql)){
		$msg+=1;
		//MSK-000143-3 The record has been successfully inserted into the database.
	}else{
		$msg+=2; 
		//MSK-000143-4 Connection problem.
	}
		
	$res=array($msg);
	echo json_encode($res);//MSK-000128-Del
	
//header("Location: view/exam_routing.php?do=alert_from_update&msg=$msg");//MSK-000143-5
}
?>