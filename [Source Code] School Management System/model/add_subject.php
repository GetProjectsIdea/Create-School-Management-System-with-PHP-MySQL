<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_subject")){

	$name=$_POST["name"]; 
	
	$sql1="SELECT * FROM subject where name='$name'";	
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	
	$name1=$row1['name'];
	$msg=0;//for alerts
	
	if($name == $name1){
		$msg+=1;
		//MSK-000143-1 The Subject name is duplicated.;	
	}else{
		//MSK-000143-2
		$sql="INSERT INTO subject (name) 
      		  VALUES ( '".$name."')";
	  
	 	if(mysqli_query($conn,$sql)){
			$msg+=2;  
			//MSK-000143-3 The record has been successfully inserted into the database.
	  	}else{
			$msg+=3;  
		  	//MSK-000143-4 Connection problem.	
	  	}
	
	}

	header("Location: view/subject.php?do=alert_from_insert&msg=$msg");//MSK-000143-5

}
?>

