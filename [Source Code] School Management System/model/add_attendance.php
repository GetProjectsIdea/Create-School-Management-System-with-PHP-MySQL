<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_attendance")){

	$index_number=$_POST["index_number"]; 
	$msg="";
	$msg1="";
	$user_type="";
	$monthly_fee=0;
	$count=0;
	$intime="";
	$outtime="";
	$alert=0;
	
	$current_month=date('F');
	$current_year=date('Y');
	$current_date=date("Y-m-d");
	$current_day=date("l");
	$current_time=date("h:i:s");
	$day_no=date("d");
	
	$sql="SELECT * FROM student where index_number='$index_number'";	
	$result=mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result) > 0) {//first if
		$user_type = "Student";
		
		if($day_no > 5){
			
			$sql2="SELECT * FROM student_payment where index_number='$index_number' and month='$current_month' and _status='Monthly_Fee'";	
			$result2=mysqli_query($conn,$sql2);
		
			if(mysqli_num_rows($result2) == 0) {
				$monthly_fee+=1; //he is not paid monthly fee
			}
		}
		
		
		$sql5="SELECT * FROM student_attendance where index_number='$index_number' and date='$current_date'";	
		$result5=mysqli_query($conn,$sql5);
	
		if(mysqli_num_rows($result5) > 0) {
			
			$sql7="SELECT * FROM student_attendance where index_number='$index_number' and date='$current_date' and _status1='outtime'";	
			$result7=mysqli_query($conn,$sql7);
	
			if(mysqli_num_rows($result7) > 0) {
				$msg+=3;
				//already have this atendats
			}else{
				$sql6="INSERT INTO student_attendance (index_number, date,month,year,time,_status1,_status2) 
     		           VALUES ( '".$index_number."','".$current_date."','".$current_month."','".$current_year."','".$current_time."','outtime','Present')";
	  
				if(mysqli_query($conn,$sql6)){
					
					$msg+=1;
					
				}else{
					$msg+=2;
				}
				
			}
		
		}else{
			
			$sql7="SELECT * FROM student_attendance where index_number='$index_number' and date='$current_date' and _status1='intime'";	
			
			$result7=mysqli_query($conn,$sql7);
	
			if(mysqli_num_rows($result7) > 0) {
				$msg+=3;
				//already have this atendats
			}else{
				
				$sql6="INSERT INTO student_attendance (index_number, date,month,year,time,_status1,_status2) 
     		       VALUES ( '".$index_number."','".$current_date."','".$current_month."','".$current_year."','".$current_time."','intime','Present')";
	  
				if(mysqli_query($conn,$sql6)){
					$msg+=1;
					
				}else{
					$msg+=2;
				}
				
			}
						
		}
		
		
	}else{//end of first if
		$sql1="SELECT * FROM teacher where index_number='$index_number'";	
		$result1=mysqli_query($conn,$sql1);	
		
		if(mysqli_num_rows($result1) > 0) {
			$user_type = "Teacher"	;
					
			$sql5="SELECT * FROM teacher_attendance where index_number='$index_number' and date='$current_date'";	
			$result5=mysqli_query($conn,$sql5);
	
			if(mysqli_num_rows($result5) > 0) {
				
				$sql7="SELECT * FROM teacher_attendance where index_number='$index_number' and date='$current_date' and _status1='outtime'";	
				$result7=mysqli_query($conn,$sql7);
	
				if(mysqli_num_rows($result7) > 0) {
					$msg+=3;
					//already have this atendats.	
				}else{
					
					$sql6="INSERT INTO teacher_attendance (index_number, date,month,year,time,_status1,_status2) 
					   VALUES ('".$index_number."','".$current_date."','".$current_month."','".$current_year."','".$current_time."','outtime','Present')";
		  
					if(mysqli_query($conn,$sql6)){
						$msg+=1;
					}else{
						$msg+=2;
					}
					
				}
			
			}else{
				$sql7="SELECT * FROM teacher_attendance where index_number='$index_number' and date='$current_date' and _status1='intime'";	
				$result7=mysqli_query($conn,$sql7);
				
				if(mysqli_num_rows($result7) > 0) {
					$msg+=3;
					//already have this atendats.	
				}else{
					$sql6="INSERT INTO teacher_attendance (index_number, date,month,year,time,_status1,_status2) 
					   VALUES ('".$index_number."','".$current_date."','".$current_month."','".$current_year."','".$current_time."','intime','Present')";
		  
					if(mysqli_query($conn,$sql6)){
						$msg+=1;
					}else{
						$msg+=2;
					}
					
				}
				
			}
			
		}else{
			$msg+=4;
		}
		
	}
	
	if($user_type == "Student"){
		header("Location:view/add_attendance.php?do=alert_from_insert_student_atd&msg=$msg&monthly_fee=$monthly_fee&index=$index_number");//MSK-000143-5
	}else if($user_type == "Teacher"){
		header("Location:view/add_attendance.php?do=alert_from_insert_teacher_atd&msg=$msg");//MSK-000143-5
	}else{
		header("Location:view/add_attendance.php?do=wrong_index&msg=$msg");
	}
	
}

?>