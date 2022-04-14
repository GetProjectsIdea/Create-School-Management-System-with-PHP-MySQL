<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="delete_exam_routing")){

	$grade_id=$_GET["grade"]; 
	$exam_id=$_GET["exam"]; 
	$subject_id=$_GET["subject"]; 
	$page=$_GET["page"]; 
	$msg=0;//for alerts
	
	$sql="DELETE FROM exam_routing WHERE grade_id='$grade_id' and exam_id='$exam_id' and subject_id='$subject_id'";		

	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg,$page,$sql);
	echo json_encode($res);//MSK-000128-Del

}
?>
