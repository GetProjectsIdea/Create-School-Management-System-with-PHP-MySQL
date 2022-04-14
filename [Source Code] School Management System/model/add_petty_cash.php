<?php
include_once('controller/config.php');
if(isset($_POST["do"])&&($_POST["do"]=="add_petty_cash")){
	
	$received_type = $_POST['received_type'];
	$index_number = $_POST['index_number'];
	$_status = $_POST['_status'];
	
	$current_year=date('Y');
	$current_month=date('F');
	$current_date=date('Y-m-d');
	$current_time=date("h:i:sa");
	
	$msg=0;//for alerts
	$total_paid=0;
	$total_paid1=0;
	$invoice_number=0;

	for($i=0;$i<count(($_POST['_desc']));$i++){
	
		$amount = $_POST['amount'];
		$total_paid+=$amount[$i];

	}
	
	if($received_type == "Admin"){
		
		$sql3="SELECT * FROM admin";
		$result3=mysqli_query($conn,$sql3);
		$row3=mysqli_fetch_assoc($result3);
		$admin_index=$row3['index_number'];
		
		$sql1 = "INSERT INTO petty_cash(received_by,approved_by,year,month,date,time,paid,received_type,_status)
			VALUES ('".$index_number."','".$admin_index."','".$current_year."','".$current_month."','".$current_date."','".$current_time."','".$total_paid."','".$received_type."','".$_status."')";
	
		if(mysqli_query($conn,$sql1)){
			
			$sql2="SELECT id FROM petty_cash ORDER BY id DESC LIMIT 1;";
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);
			$id=$row2['id'];
			$invoice_number=$id;
			$msg+=1;
			
		}else{
			$msg+=2;
		}


		for($i=0;$i<count(($_POST['_desc']));$i++){
		
			$_desc = $_POST['_desc'];
			$amount = $_POST['amount'];
			
			$sql = "INSERT INTO petty_cash_history(_desc,received_by,approved_by,year,month,date,time,amount,total_paid,invoice_number,received_type,_status)
					VALUES ('".$_desc[$i]."','".$index_number."','".$admin_index."','".$current_year."','".$current_month."','".$current_date."','".$current_time."','".$amount[$i]."','".$total_paid."','".$invoice_number."','".$received_type."','".$_status."')";
					
			mysqli_query($conn,$sql);
				
			
		}
		
	}
	
	if($received_type == "Teacher"){
		
		$sql1 = "INSERT INTO petty_cash(received_by,year,month,date,time,paid,received_type,_status)
			VALUES ('".$index_number."','".$current_year."','".$current_month."','".$current_date."','".$current_time."','".$total_paid."','".$received_type."','".$_status."')";
	
		if(mysqli_query($conn,$sql1)){
			$sql2="SELECT id FROM petty_cash ORDER BY id DESC LIMIT 1;";
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);
			$id=$row2['id'];
			$invoice_number=$id;
			$msg+=1;
			
		}else{
			$msg+=2;
		}

		for($i=0;$i<count(($_POST['_desc']));$i++){
		
			$_desc = $_POST['_desc'];
			$amount = $_POST['amount'];
			
			//$total_paid1=$amount[$last_record];
			
			$sql = "INSERT INTO petty_cash_history(_desc,received_by,year,month,date,time,amount,total_paid,invoice_number,received_type,_status)
					VALUES ('".$_desc[$i]."','".$index_number."','".$current_year."','".$current_month."','".$current_date."','".$current_time."','".$amount[$i]."','".$total_paid."','".$invoice_number."','".$received_type."','".$_status."')";
					
			mysqli_query($conn,$sql);
				
			
		}
		
	}
	
	if(isset($_POST["user_type"])&&($_POST["user_type"]=="Admin")){
		header("Location: view/petty_cash.php?do=alert_from_insert&msg=$msg");//MSK-000143-5
	}
	
	if(isset($_POST["user_type"])&&($_POST["user_type"]=="Teacher")){
		header("Location: view/my_petty_cash.php?do=alert_from_insert&msg=$msg");//MSK-000143-5
	}
	
}

?>