<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="add_friends")){
	
	$my_type=$_GET['my_type'];
	$my_index=$_GET['my_index'];
	$friend_type=$_GET['friend_type']; 
	$friend_index=$_GET['friend_index'];
	
	$msg=0;
	
	$sql1="SELECT * FROM my_friends ORDER BY id DESC LIMIT 1";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$last_id=$row1['id'];
	$conversation_id=$last_id+1; 
	
	$sql="INSERT INTO my_friends(my_index,friend_index,_status,conversation_id,my_type,	friend_type) 
          VALUES ( '".$my_index."','".$friend_index."','Friend_Request_Sent','".$conversation_id."','".$my_type."','".$friend_type."')";
	  
	if(mysqli_query($conn,$sql)){
		
		$sql1="INSERT INTO my_friends(my_index,friend_index,_status,conversation_id,my_type,friend_type) 
          	  VALUES ( '".$friend_index."','".$my_index."','Pending','".$conversation_id."','".$friend_type."','".$my_type."')";
		
		if(mysqli_query($conn,$sql1)){
	  		$msg+=1; 
		}
	}else{
		$msg+=2; 	
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000143-U-7

}
?>