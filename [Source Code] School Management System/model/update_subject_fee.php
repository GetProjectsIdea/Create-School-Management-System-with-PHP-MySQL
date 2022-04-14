<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="update_subject_fee")){
	
$id=$_GET['id'];	
$fee = $_GET['fee'];

$msg=0;//for alerts
	
	$sql = "update subject_routing set fee='".$fee."' where id='$id'";

	if(mysqli_query($conn,$sql)){
		$msg+=1;
		//MSK-000143-3 The record has been successfully inserted into the database.
	}else{
		$msg+=2; 
		//MSK-000143-4 Connection problem.
	}
		
	$res=array($msg);
	echo json_encode($res);//MSK-000128-Del
	

}
?>