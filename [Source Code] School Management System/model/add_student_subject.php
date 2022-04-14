<?php
include_once("../controller/config.php");
$index=$_GET['index'];
$current_year=date('Y');
$msg=0;//for alerts

$sql1="DELETE FROM student_subject WHERE index_number='$index'";	

if(mysqli_query($conn,$sql1)){
	$msg+=1;
	for($i=0;$i<count(json_decode($_GET['id']));$i++){

		$id = json_decode($_GET['id'], true);
	
		$sql = "INSERT INTO student_subject(index_number,sr_id,year)
				VALUES ('".$index."','".$id[$i]."','".$current_year."')";
		mysqli_query($conn,$sql);
		
	}
	
}else{
	$msg+=2; 
}

	$res=array($msg,$sql1);
	echo json_encode($res);//MSK-000128-Del

?>


	