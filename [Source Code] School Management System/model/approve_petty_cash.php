<?php
include_once('../controller/config.php');

$id=$_GET['id'];
$approved_by=$_GET['admin_index'];
$msg=0;
		
$sql = "update petty_cash set _status='Active',approved_by='".$approved_by."' where id='$id'";
		
if(mysqli_query($conn,$sql)){
	
	$sql1 = "update petty_cash_history set _status='Active',approved_by='".$approved_by."' where invoice_number='$id'";	
	
	if(mysqli_query($conn,$sql1)){			
		$msg+=1;
	}
	
}else{
	$msg+=2;
	//MSK-000143-U-6 Connection problem	
}

$res=array($msg,$approved_by);
echo json_encode($res);//MSK-000143-U-7


?>