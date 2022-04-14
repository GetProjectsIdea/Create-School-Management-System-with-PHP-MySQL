<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_events")){

	$my_index=$_POST["my_index"]; 
	$my_type=$_POST["my_type"];  
	$title=$_POST["title"]; 
	$category_id=$_POST["category"];
	$date_time_range=$_POST["date_time_range"];
	$note=$_POST["note"]; 
	$color=$_POST["color"];
	
	$month1=date('F');
	$year=date('Y');
	$date=date("Y-m-d");
	 
	$date_time_range1 = explode("-",$date_time_range);
	
	$start_date_time = date_create($date_time_range1[0]);
	$end_date_time = date_create($date_time_range1[1]);
	
	$start_date_time1=date_format($start_date_time,"Y-m-d H:i:s");
	$end_date_time1=date_format($end_date_time,"Y-m-d H:i:s");
	
	$year=date_format($start_date_time,"Y");
	$month=date_format($start_date_time,"m")-1;
	
	$prefix="";
	$grade_id="";
	if(isset($_POST["checkbox"])){
		for($i=0;$i<count(($_POST["checkbox"]));$i++){
		
			$grade=$_POST["checkbox"][$i];
			
			$grade_id.=$prefix.$grade;
			$prefix=',';
	
		}
	}
	
	$msg=0;//for alerts

	$sql="INSERT INTO events (title,note,color,category_id,grade_id,create_by,creator_type,start_date_time,end_date_time,year,month) 
     	  VALUES ( '".$title."','".$note."','".$color."','".$category_id."','".$grade_id."','".$my_index."','".$my_type."','".$start_date_time1."','".$end_date_time1."','".$year."','".$month."')";
		  
	if(mysqli_query($conn,$sql)){
		  
		//MSK-000143-3 The record has been successfully inserted into the database.
		$last_id = $conn->insert_id;
		$sql1="INSERT INTO main_notifications(notification_id,_status,_isread,year,month,date) 
     	       VALUES ('".$last_id."','Events',0,'".$year."','".$month1."','".$date."')";
		mysqli_query($conn,$sql1);
		$msg+=2;
		
	}else{
		$msg+=3;  
		//MSK-000143-4 Connection problem.	
	}

	if($category_id == 1){//All
		
		include_once('../controller/config.php');
		
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number."','Student',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}
	
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number2."','Teacher',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
	
		$sql4="SELECT * FROM parents";
		$result4=mysqli_query($conn,$sql4);
		if(mysqli_num_rows($result4) > 0){
			while($row4=mysqli_fetch_assoc($result4)){
				$index_number4=$row4['index_number'];
				
				$sql5="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number4."','Parents',0)";
			  
				mysqli_query($conn,$sql5);
				
			}
			
		}
	
	}

	if($category_id == 2){//All Teachers & Student
	
	include_once('../controller/config.php');
		
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number."','Student',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}
	
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number2."','Teacher',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
	
	}	
		
	if($category_id == 3){//All Teachers & Specific Grades
	
		if(isset($_POST["checkbox"])){
			for($i=0;$i<count(($_POST["checkbox"]));$i++){
			
				$grade1=$_POST["checkbox"][$i];
				
				//grades tika wena wenama ganne ethakota for loop ekak athule meeka run wenna oone
				$sql="select student.index_number as std_index 
					  from student
					  inner join student_grade
					  on student.index_number=student_grade.index_number
					  where student_grade.year='$year' and student_grade.grade_id='$grade1'";
					  
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) > 0){
					while($row=mysqli_fetch_assoc($result)){
						$index_number=$row['std_index'];
						
						$sql1="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
							  VALUES ( '".$last_id."','".$index_number."','Student',0)";
					  
						mysqli_query($conn,$sql1);
						
					}
					
				}	
				
			}//end of the for loop
		
		}//if isset
		
		
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number2."','Teacher',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
		
	}//All Teachers & Specific Grades		

	if($category_id == 4){//Only Specific Grades
	
		if(isset($_POST["checkbox"])){
			for($i=0;$i<count(($_POST["checkbox"]));$i++){
			
				$grade1=$_POST["checkbox"][$i];
				
				//grades tika wena wenama ganne ethakota for loop ekak athule meeka run wenna oone
				$sql="select student.index_number as std_index 
					  from student
					  inner join student_grade
					  on student.index_number=student_grade.index_number
					  where student_grade.year='$year' and student_grade.grade_id='$grade1'";
					  
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) > 0){
					while($row=mysqli_fetch_assoc($result)){
						$index_number=$row['std_index'];
						
						$sql1="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
							  VALUES ( '".$last_id."','".$index_number."','Student',0)";
					  
						mysqli_query($conn,$sql1);
						
					}
					
				}	
				
			}
		
		}
		
	}//Only Specific Grades	
	
	if($category_id == 5){//Only Teachers
		
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number2."','Teacher',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
		
	}

	if($category_id == 6){//Only Students
	
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number."','Student',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}	
			
	}

	if($category_id == 7){//Only Parents
		
		$sql4="SELECT * FROM parents";
		$result4=mysqli_query($conn,$sql4);
		if(mysqli_num_rows($result4) > 0){
			while($row4=mysqli_fetch_assoc($result4)){
				$index_number4=$row4['index_number'];
				
				$sql5="INSERT INTO notification_history (notification_id,index_number,user_type,_isread) 
					  VALUES ( '".$last_id."','".$index_number4."','Parents',0)";
			  
				mysqli_query($conn,$sql5);
				
			}
			
		}
		
		
	}

	if($my_type == "Admin"){
		header("Location: view/my_events.php?do=alert_from_insert&msg=$msg");//MSK-000143-5	
	}
	
	if($my_type == "Teacher"){
		header("Location: view/my_events2.php?do=alert_from_insert&msg=$msg");//MSK-000143-5
	}

}

?>