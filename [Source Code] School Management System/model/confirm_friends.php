<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="confirm_friends")){
	
	$my_index=$_GET['my_index'];
	$friend_index=$_GET['friend_index'];
	$msg=0;
	
	$sql="update my_friends set _status='Friend',_isread='1' where my_index='$my_index' and friend_index='$friend_index'";
	  
	if(mysqli_query($conn,$sql)){
		
		$sql1="update my_friends set _status='Friend',_isread='1' where my_index='$friend_index' and friend_index='$my_index'";
		
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