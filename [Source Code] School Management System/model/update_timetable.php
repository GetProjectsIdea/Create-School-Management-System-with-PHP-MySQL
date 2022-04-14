<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="update_timetable")){

	$id=$_POST["id"];
	$grade=$_POST["grade"]; 
	$day=$_POST["day"]; 
	$subject_id=$_POST["subject_id"];
	$teacher_id=$_POST["teacher_id"]; 
	$classroom_id=$_POST["classroom_id"];
	$start_time=$_POST["start_time"]; 
	$end_time=$_POST["end_time"]; 
	
	$msg=0;//for alerts
	
	$sql1="SELECT * FROM timetable WHERE day='$day' and classroom_id=$classroom_id and start_time=$start_time";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$id1=$row1['id'];
	$subject_id1=$row1['subject_id'];
	$teacher_id1=$row1['teacher_id'];
	$end_time1=$row1['end_time'];
	
	if($id == $id1){//MSK-000143-U-1
		if($end_time == $end_time1){//MSK-000143-U-2
			if($subject_id != $subject_id1 || $teacher_id != $teacher_id1 ){//MSK-000143-U-3
				$sql="update timetable set subject_id='".$subject_id."', teacher_id='".$teacher_id."' where id='$id'";
      
	  				if(mysqli_query($conn,$sql)){
						$msg+=1; 
						//MSK-000143-U-4 The record has been successfully updated in the database.
	  				}else{
						$msg+=2;
						//MSK-000143-U-5  Connection problem
	  				}
				
			}else{
				$msg+=3; 
				//MSK-000143-U-6 You didn't make any changes.:D
			}

		}else{//MSK-000143-U-7
			
			$sql2="SELECT * FROM timetable WHERE day='$day' and classroom_id=$classroom_id and end_time > $start_time and (start_time <= $start_time or start_time<$end_time) and id!=$id";
		$result2=mysqli_query($conn,$sql2);
		
			if(mysqli_num_rows($result2) > 0){
				$msg+=4; 
				//MSK-000143-U-8 At this time there already have class, in that classroom.
			}else{
				//MSK-000143-U-9
				$sql="update timetable set subject_id='".$subject_id."',teacher_id='".$teacher_id."',end_time='".$end_time."' where id='$id'";
      
	  			if(mysqli_query($conn,$sql)){
					$msg+=1;  
					//MSK-000143-U-10 The record has been successfully updated in the database.
	  			}else{
					$msg+=2; 
					//MSK-000143-U-11 Connection problem.
	  			}

			}
			
		}
		
	}else{//MSK-000143-U-12
		
		$sql2="SELECT * FROM timetable WHERE day='$day' and classroom_id=$classroom_id and end_time > $start_time and (start_time <= $start_time or start_time<$end_time) and id!=$id";
		$result2=mysqli_query($conn,$sql2);
		
		if(mysqli_num_rows($result2) > 0){
			$msg+=4; 
			//MSK-000143-U-13 At this time there already have class, in that classroom.
		}else{
			//MSK-000143-U-14
			$sql="update timetable set day='".$day."', subject_id='".$subject_id."',teacher_id='".$teacher_id."',classroom_id='".$classroom_id."',start_time='".$start_time."',end_time='".$end_time."' where id='$id'";
      
	  		if(mysqli_query($conn,$sql)){
				$msg+=1;  
				//MSK-000143-U-15 The record has been successfully updated in the database.
	  		}else{
				$msg+=2; 
				//MSK-000143-U-16 Connection problem.
	  		}

		}
		
	}
	
	if(isset($_POST["do1"])&&($_POST["do1"]=="update_timetable1")){
		header("Location: view/timetable.php?do=alert_from_update&msg=$msg&grade=$grade");//MSK-000143-U-17
	}
	
	if(isset($_POST["do2"])&&($_POST["do2"]=="update_timetable2")){
		header("Location: view/my_timetable2.php?do=alert_from_update&msg=$msg");//MSK-000143-U-17
	}

}
?>

