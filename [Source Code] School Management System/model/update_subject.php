<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="update_subject")){

	$id=$_GET['id'];
	$name=$_GET['name']; 
	
	$sql="SELECT * FROM subject where name='$name'";	
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	
	$id1=$row['id'];
	$name1=$row['name'];
	
	$msg=0;//for alerts
	$id2="";
	$name2="";

	if($name == $name1){
		
		if($id == $id1){
			$msg+=3;
			//MSK-000143-U-1 You didn't make any changes.:D
		}else{
			$msg+=4;
			//MSK-000143-U-2 The subject is duplicated
		}

	}else{//MSK-000143-U-3
				
		$sql1 = "update subject set name='".$name."' where id='$id'";
		
		if(mysqli_query($conn,$sql1)){
			
			$msg+=1;
			//MSK-000143-U-4 The record has been successfully updated in the database
				
			$sql2="SELECT * FROM subject where id='$id'";	
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);//MSK-000143-U-5
				
			$id2=$row2['id'];
			$name2=$row2['name'];
				
		}else{
			$msg+=2;
			//MSK-000143-U-6 Connection problem		
		}
	
	}

$res=array($id2,$name2,$msg);
echo json_encode($res);//MSK-000143-U-7

}
?>