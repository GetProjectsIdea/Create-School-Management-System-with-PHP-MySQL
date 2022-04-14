<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_group_message")){

	$my_index=$_POST["my_index"]; 
	$my_type=$_POST["my_type"];  
	$group_id=$_POST["group"];
	$message=$_POST["gmessage"]; 

	$date=date("Y-m-d");
	$time=date("h:i:sa");
	$year=date("Y");
	
	$sql6="SELECT conversation_id FROM my_friends ORDER BY id DESC LIMIT 1;";
	$result6=mysqli_query($conn,$sql6);
	$row6=mysqli_fetch_assoc($result6);
	$conversation_id = $row6['conversation_id'];
	$conversation_id1 = $conversation_id + 1;
	
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
	
	
	
	$sql7="INSERT INTO group_message (conversation_id,message,sender_index,sender_type,group_id,grade,date,time) 
		   VALUES ('".$conversation_id1."','".$message."','".$my_index."','".$my_type."','".$group_id."','".$grade_id."','".$date."','".$time."')";
	
	if(mysqli_query($conn,$sql7)){
		$msg+=1;
	}else{
		$msg+=2;
	}		  
	

	if($group_id == 1){//All
		
		include_once('../controller/config.php');
		
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number."','Student','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}
	
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number2."','Teacher','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
	
		$sql4="SELECT * FROM parents";
		$result4=mysqli_query($conn,$sql4);
		if(mysqli_num_rows($result4) > 0){
			while($row4=mysqli_fetch_assoc($result4)){
				$index_number4=$row4['index_number'];
				
				$sql5="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number4."','Parents','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql5);
				
			}
			
		}
	
	}

	if($group_id == 2){//All Teachers & Student
	
	include_once('../controller/config.php');
		
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number."','Student','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}
	
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number2."','Teacher','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
	
	}	
		
	if($group_id == 3){//All Teachers & Specific Grades
	
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
						
						$sql1="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
							   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number."','Student','".$message."','".$date."','".$time."',0)";
					  
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
				
				$sql3="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number2."','Teacher','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
		
	}//All Teachers & Specific Grades		

	if($group_id == 4){//Only Specific Grades
	
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
						
						$sql1="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
							   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number."','Student','".$message."','".$date."','".$time."',0)";
					  
						mysqli_query($conn,$sql1);
						
					}
					
				}	
				
			}
		
		}
		
	}//Only Specific Grades	
	
	if($group_id == 5){//Only Teachers
		
		$sql2="SELECT * FROM teacher";
		$result2=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row2=mysqli_fetch_assoc($result2)){
				$index_number2=$row2['index_number'];
				
				$sql3="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number2."','Teacher','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql3);
				
			}
			
		}
		
	}

	if($group_id == 6){//Only Students
	
		$sql="SELECT * FROM student";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$index_number=$row['index_number'];
				
				$sql1="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number."','Student','".$message."','".$date."','".$time."',0)";
			  
				mysqli_query($conn,$sql1);
				
			}
			
		}	
			
	}

	if($group_id == 7){//Only Parents
		
		$sql4="SELECT * FROM parents";
		$result4=mysqli_query($conn,$sql4);
		if(mysqli_num_rows($result4) > 0){
			while($row4=mysqli_fetch_assoc($result4)){
				$index_number4=$row4['index_number'];
				
				$sql5="INSERT INTO chat (conversation_id,sender_index,sender_type,receiver_index,receiver_type,msg,date,time,_isread) 
					   VALUES ('".$conversation_id1."','".$my_index."','".$my_type."','".$index_number4."','Parents','".$message."','".$date."','".$time."',0)";;
			  
				mysqli_query($conn,$sql5);
				
			}
			
		}
		
		
	}

	if($my_type == "Admin"){
		header("Location: view/group_message.php?do=alert_from_insert&msg=$msg");//MSK-000143-5	
	}
	
	if($my_type == "Teacher"){
		//header("Location: view/my_events2.php?do=alert_from_insert&msg=$msg");//MSK-000143-5
	}

}

?>