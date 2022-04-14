<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_subject_routing")){

	$grade_id=$_POST['grade_id'];	
	$subject_id=$_POST['subject_id'];
	$teacher_id=$_POST['teacher_id'];
	$fee=$_POST['fee'];

	$sql1="SELECT * FROM subject_routing where grade_id='$grade_id' and subject_id='$subject_id' and teacher_id='$teacher_id'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);

	$grade_id1=$row1['grade_id'];	
	$subject_id1=$row1['subject_id'];
	$teacher_id1=$row1['teacher_id'];
	$fee1=$row1['fee'];

	$msg=0;//for alerts

	if($grade_id == $grade_id1 && $subject_id == $subject_id1 && $teacher_id == $teacher_id1){
		$msg+=1;
		//MSK-000143-1 The record has been duplicated.
		
	}else{//MSK-000143-2
	
		$sql="INSERT INTO subject_routing(grade_id,subject_id,teacher_id,fee) 
      VALUES ( '".$grade_id."','".$subject_id."','".$teacher_id."','".$fee."')";
	  
	 	if(mysqli_query($conn,$sql)){
			$msg+=2;  
			//MSK-000143-3 The record has been successfully inserted into the database.
	  	}else{
			$msg+=3;
			//MSK-000143-4 Connection problem.  
	  	}
		
	}

	header("Location: view/subject_routing.php?do=alert_from_insert&msg=$msg");//MSK-000143-5
	
}

?>