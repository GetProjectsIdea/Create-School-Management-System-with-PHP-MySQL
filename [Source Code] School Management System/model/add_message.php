<?php
include_once('../controller/config.php');

if(isset($_GET["do"])&&($_GET["do"]=="add_message")){

	$conversation_id = $_GET['conversation_id'];
	$user_index = $_GET['user_index'];
	$msg = $_GET['msg'];
	$user_type = $_GET['user_type'];
	$current_date=date("Y-m-d");
	$current_time=date("H:i:s");
	
	$alert=0;
	$msg_count=0;
	
	$sql="INSERT INTO online_chat (	conversation_id, user_index,msg,user_type,date,time) 
     	  VALUES ( '".$conversation_id."','".$user_index."','".$msg."','".$user_type."','".$current_date."','".$current_time."')";
		
	if(mysqli_query($conn,$sql)){
		$alert+=1;
		//MSK-000143-U-4 The record has been successfully updated in the database.
		
		$sql1="SELECT count(id)
		 	   FROM online_chat
		       WHERE user_index='$user_index' AND conversation_id='$conversation_id'";
			   
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$msg_count=$row1['count(id)'];
		
		
	}else{
		$alert+=2;
		//MSK-000143-U-6 Connection problem	
	}
				
$res=array($alert,$conversation_id,$msg_count);
echo json_encode($res);//MSK-000143-U-7

}
?>