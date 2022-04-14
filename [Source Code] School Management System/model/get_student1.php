<?php

include_once('../controller/config.php');
$index=$_GET["index"];
$msg=0;

$sql = "SELECT * FROM student WHERE index_number=$index";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	$msg=1;
}else{
	$msg=2;
}
$row1=array($msg);
echo json_encode($row1);//MSK-00117 

?>	