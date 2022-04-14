<?php
include_once("../controller/config.php");
$index=$_GET['index'];
$page=$_GET['page'];
$msg=0;

$sql="delete id1,id2.*
      from student_subject id1
      inner join student_grade id2
      on id1.index_number=id2.index_number
      where id1.index_number='$index'";
if(mysqli_query($conn,$sql)){

	$msg+=1;
	
}else{
	$msg+=2; 
}

	$res=array($msg,$page,$sql);
	echo json_encode($res);//MSK-000128-Del

?>


	