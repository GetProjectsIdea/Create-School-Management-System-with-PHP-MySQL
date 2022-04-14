<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="delete_friend_request")){

	$my_index=$_GET["my_index"]; 
	$friend_index=$_GET["friend_index"]; 
	
	//$page=$_GET["page"]; 
	$msg=0;//for alerts

	$sql="DELETE FROM my_friends WHERE my_index='$my_index' AND friend_index='$friend_index'";	

	if(mysqli_query($conn,$sql)){
		
		$sql1="DELETE FROM my_friends WHERE my_index='$friend_index' AND friend_index='$my_index'";	
		
		if(mysqli_query($conn,$sql1)){
			$msg+=1; 	
		}
		
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);//MSK-000128-Del

}
?>
