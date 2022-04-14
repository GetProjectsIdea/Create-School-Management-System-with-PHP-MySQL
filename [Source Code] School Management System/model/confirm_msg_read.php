<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_msg_read")){
	
	$conversation_id=$_GET['conversation_id'];
	$friend_index=$_GET['friend_index'];
	$msg=0;
	
	$sql="update online_chat set _isread='1' where 	conversation_id='$conversation_id' and user_index='$friend_index'";
	  
	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000143-U-7

}
?>