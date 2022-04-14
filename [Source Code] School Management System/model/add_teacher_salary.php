<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_teacher_salary")){
	
	$index_number=$_POST['index_number'];
	$id=$_POST['teacher_id'];
	$status=$_POST['type'];
	$paid=$_POST['amount'];
	$page=$_POST['page'];
	$invoice_number=$_POST['invoice_number'];
	
	$month=date('F');
	$year=date('Y');
	$date=date("Y-m-d");
	
	$msg=0;
	$msg1=0;
	$msg2=0;

	$sql="select subject_routing.fee as sr_fee,subject_routing.id as sr_id,subject_routing.grade_id as g_id,subject_routing.subject_id as s_id,grade.hall_charge as h_charge
		  from subject_routing
		  inner join grade
		  on subject_routing.grade_id=grade.id
		  inner join subject
		  on subject_routing.subject_id=subject.id
		  where subject_routing.teacher_id='$id'";
          
	$result=mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
				
			$sr_id= $row['sr_id'];
			$grade_id=$row['g_id'];
			$subject_id=$row['s_id'];
			$subject_fee=$row['sr_fee'];
			$hall_charge=$row['h_charge'];
				
			$sql2="SELECT 
				   DISTINCT index_number
				   FROM
					  student_subject
				   WHERE
					  _status='leave' and year='2017'  
				   ORDER BY
					  index_number";
	
			$result2=mysqli_query($conn,$sql2);
	
			if(mysqli_num_rows($result2) > 0){
				while($row2=mysqli_fetch_assoc($result2)){	
					$index_number=$row2['index_number'];
					
					$sql3="SELECT * FROM student_payment_history WHERE index_number='$index_number' and teacher_id='$id' and grade_id='$grade_id' and subject_id='$subject_id' and _status='Monthly_Fee' and month='$current_month'";
				
					$result3=mysqli_query($conn,$sql3);
					if(mysqli_num_rows($result2) > 0){
						while($row3=mysqli_fetch_assoc($result3)){
							
							$index1=$row3['index_number'];
							$subject_fee1=$row3['subject_fee'];
							$student_count1=mysqli_num_rows($result2);
						   
					   }
					 
					}
				}
		
			 }
				
			$sql1="SELECT count(index_number)
				   FROM student_subject
				   WHERE sr_id='$sr_id' and	_status='' and year='$year'";
					   
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$s_count=$row1['count(index_number)'];
			$student_count=$s_count+$student_count1;
				
			$count++;
				
			$subtotal=$row['sr_fee']*$student_count;
			$subtotal1=$subtotal-($subtotal*$hall_charge/100);
			$total+=$subtotal1;
				
			$subtotal1 = number_format($subtotal1, 2, '.', '');
			$total = number_format($total, 2, '.', '');
			
			$sql2="INSERT INTO teacher_salary_history(index_number,grade_id,subject_id,subject_fee,student_count,hall_charge,subtotal,paid,_status,month,year,date,invoice_number) 
				   VALUES ( '".$index_number."','".$grade_id."','".$subject_id."','".$subject_fee."','".$student_count."','".$hall_charge."','".$subtotal1."','".$paid."','".$status."','".$month."','".$year."','".$date."','".$invoice_number."')";
			
			mysqli_query($conn,$sql2);
				
		}
	}
	$sql3="INSERT INTO teacher_salary(index_number,month,year,date,paid,_status) 
      	   VALUES ('".$index_number."','".$month."','".$year."','".$date."','".$paid."','".$status."')";
		
	if(mysqli_query($conn,$sql3)){
		$msg+=1; //The record has been successfully inserted into the database.
	}else{
		$msg+=2; //Connection problem.
	} 
	 
header("Location: view/all_teacher.php?do=alert_from_salary_insert&msg=$msg&page=$page&teacher_id=$id&invoice_number=$invoice_number&desc='$status'&total_salary=$total&paid=$paid");//MSK-000143-5 
}

?> 