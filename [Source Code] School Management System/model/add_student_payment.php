<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_student_payment")){

	$index=$_POST["index_number"];
	$total_sfee=$_POST["totalsfee"]; 
	$invoice_number=$_POST["invoice_number"];
	$status=$_POST['type'];
	$paid=$_POST['amount'];
	
	$current_year=date('Y');
	$current_month=date('F');
	$current_date=date('Y-m-d');
	$msg=0;
	$monthly_fee=0;
	$page=1;
	
	$sql="INSERT INTO student_payment (index_number,paid,_status,year,month,date) 
		  VALUES ( '".$index."','".$total_sfee."','".$status."','".$current_year."','".$current_month."','".$current_date."')";
	if(mysqli_query($conn,$sql)){
		$msg+=1;  
	}else{
		$msg+=2;  
	}

	$sql3="SELECT * FROM student_grade WHERE index_number='$index' and year='$current_year'";
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
		$monthly_fee+=$subject_fee;
		
		$sql4="INSERT INTO student_payment_history (index_number,grade_id,subject_id,teacher_id,subject_fee,subtotal,_status,invoice_number,month,year,date) 
			   VALUES ( '".$index."','".$grade_id."','".$subject_id."','".$teacher_id."','".$subject_fee."','".$subject_fee."','".$status."','".$invoice_number."','".$current_month."','".$current_year."','".$current_date."')";
			  
		mysqli_query($conn,$sql4);
	
	}
	
	if(isset($_POST["showPage"])&&($_POST["showPage"]=="all_student")){
		header("Location:view/all_student.php?do=alert_from_payment_insert&msg=$msg&page=$page&index=$index&desc='$status'&monthly_fee=$monthly_fee&paid=$paid&invoice_number=$invoice_number&grade=$grade_id");
	}
	
	if(isset($_POST["showPage"])&&($_POST["showPage"]=="student_payment")){
		header("Location:view/student_payment.php?do=alert_from_payment_insert&msg=$msg&page=$page&index=$index&desc='$status'&monthly_fee=$monthly_fee&paid=$paid&invoice_number=$invoice_number&grade=$grade_id");
	}

}
?>

