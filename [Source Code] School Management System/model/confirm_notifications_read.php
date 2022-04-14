<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_notifications_read")){
	
	$id=$_GET['id'];
	$msg=0;
	
	$sql="update main_notifications set _isread='1' where notification_id='$id'";
	  
	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000143-U-7

}
?>