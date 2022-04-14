<?php
include_once('controller/config.php');

if(isset($_POST["do"])&&($_POST["do"]=="update_events")){
	$id = $_POST["event_id"];
	$title=$_POST["title"]; 
	$category_id=$_POST["category"];
	$date_time_range=$_POST["date_time_range"];
	$note=$_POST["note"]; 
	$color=$_POST["color"];
	$date_time_range2="";
	$my_type=$_POST["my_type"];
	
	
	$sql="SELECT * FROM events WHERE id='$id'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	
	$s_date = $row['start_date_time'];
	$e_date = $row['end_date_time'];
	$date_time_range2=$s_date." - ".$e_date;
	
	$prefix="";
	$grade_id="";
	$msg=0;
	
	if(isset($_POST["checkbox1"])){
		for($i=0;$i<count(($_POST["checkbox1"]));$i++){
	
			$grade=$_POST["checkbox1"][$i];
			
			$grade_id.=$prefix.$grade;
			$prefix=',';

		}
	}
	
	if($date_time_range == $date_time_range2){
		$sql1 = "update events set title='".$title."',note='".$note."',color='".$color."',category_id='".$category_id."',grade_id='".$grade_id."' where id='$id'";
			
		if(mysqli_query($conn,$sql1)){
					
			$msg+=1;
			//MSK-000143-U-3 The record has been successfully updated in the database
		
		}else{
			$msg+=2;
			//MSK-000143-U-5 Connection problem
		}
	}else{
		$date_time_range1 = explode("-",$date_time_range,4);
	
		$start_date_time = date_create($date_time_range1[0]);
		$end_date_time = date_create($date_time_range1[1]);
	
		$start_date_time1=date_format($start_date_time,"Y-m-d H:i:s");
		$end_date_time1=date_format($end_date_time,"Y-m-d H:i:s");
		
		
		$sql1 = "update events set title='".$title."',note='".$note."',color='".$color."',category_id='".$category_id."',grade_id='".$grade_id."',start_date_time='".$start_date_time1."',end_date_time='".$end_date_time1."' where id='$id'";
			
		if(mysqli_query($conn,$sql1)){
					
			$msg+=1;
			//MSK-000143-U-3 The record has been successfully updated in the database
		
		}else{
			$msg+=2;
			//MSK-000143-U-5 Connection problem
		}
		
	}
	
	if($my_type == "Admin"){
		header("Location: view/my_events.php?do=alert_from_update&msg=$msg");//MSK-000143-5	
	}
	
	if($my_type == "Teacher"){
		header("Location: view/my_events2.php?do=alert_from_update&msg=$msg");//MSK-000143-5
	}

echo $sql1;

}
?>