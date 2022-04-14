<?php
include_once('../controller/config.php');

	$index=$_GET["index"];
	$afee=$_GET["afee"];
	$total_sfee=$_GET["totalsfee"]; 
	
	$invoice_number=$_GET["inv_num"];
	
	$current_month=date('F');
	$current_year=date('Y');
	$current_date=date('Y-m-d');
	
	$msg=0;
	$msg_afee=0;
	$msg_mfee=0;
	
	if($afee){
		$sql="INSERT INTO student_payment(index_number,paid,_status,year,month,date) 
			  VALUES ( '".$index."','".$afee."','Admission Fee','".$current_year."','".$current_month."','".$current_date."')";
		 
			if(mysqli_query($conn,$sql)){
			
				$msg_afee+=1;  
				
			}else{
			  
				$msg_afee+=2;  
					
			}	
	}	

	if($total_sfee){
		$sql="INSERT INTO student_payment(index_number,paid,_status,year,month,date) 
			  VALUES ( '".$index."','".$total_sfee."','Monthly Fee1','".$current_year."','".$current_month."','".$current_date."')";
		  
			if(mysqli_query($conn,$sql)){
				$msg_mfee+=1;  
			}else{
				$msg_mfee+=2;  
			}	
		
	}	

	$sql3="SELECT * FROM student_grade WHERE index_number='$index'";
	$result3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($result3);
	$grade_id=$row3['grade_id'];
	
	$sql1="SELECT * FROM student_subject WHERE index_number='$index' and year='$current_year'";	
	$result1=mysqli_query($conn,$sql1);
	
	while($row1=mysqli_fetch_assoc($result1)){
		
		$id=$row1['sr_id'];
		
		$sql2="select subject.id as s_id, subject_routing.fee as s_fee, subject_routing.teacher_id as t_id
			   from subject_routing
			   inner join subject
			   on subject_routing.subject_id=subject.id
			   where subject_routing.id='$id'";
		
		$result2=mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_assoc($result2);
	
		$subject_id=$row2['s_id'];
		$teacher_id=$row2['t_id'];
		$subject_fee=$row2['s_fee'];
		
		$sql4="INSERT INTO student_payment_history (index_number,grade_id,subject_id,teacher_id,subject_fee,subtotal,_status,invoice_number,month,year,date) 
			   VALUES ( '".$index."','".$grade_id."','".$subject_id."','".$teacher_id."','".$subject_fee."','".$subject_fee."','Monthly Fee','".$invoice_number."','".$current_month."','".$current_year."','".$current_date."')";
			  
		mysqli_query($conn,$sql4);
	
	}
		
	if($msg_afee == 1 && $msg_mfee == 1){
		$msg+=1;
		
	}else{
		$msg+=2;
	}
	
$alert=array($msg);
echo json_encode($alert);//MSK-000141


?>

