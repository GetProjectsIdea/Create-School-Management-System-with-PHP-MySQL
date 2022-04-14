<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="delete_range_grade")){

	$id=$_GET["id"];  
	$msg=0;//for alerts
	
	$sql="DELETE FROM exam_range_grade WHERE id='$id'";	

	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000128-Del

}
?>
