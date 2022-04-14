<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="delete_record")){

	$id=$_GET["id"]; 
	$table_name=$_GET["table_name"]; 
	$page=$_GET["page"]; 
	$msg=0;//for alerts

	$sql="DELETE FROM $table_name WHERE id='$id'";	

	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg,$page);
	echo json_encode($res);//MSK-000128-Del

}
?>
