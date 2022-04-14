<?php
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="leave_student")){

	$id=$_GET["id"]; 
	$index_number=$_GET["index_number"];
	$page=$_GET["page"]; 
	$msg=0;//for alerts
	
	$sql1="update student set _status='leave' where id='$id' and index_number='$index_number'";	
	
	if(mysqli_query($conn,$sql1)){

		$sql="delete id2,id3.*
		      from student id1
		      inner join student_subject id2
		      on id1.index_number=id2.index_number
		      inner join student_grade id3
		      on id1.index_number=id3.index_number
		      where id1.index_number='$index_number' and id1.id='$id'";	
	
		if(mysqli_query($conn,$sql)){
			$msg+=1; 
		}else{
			$msg+=2; 
		}
		
	}
	
	$res=array($msg,$page);
	echo json_encode($res);//MSK-000128-Del

}
?>
