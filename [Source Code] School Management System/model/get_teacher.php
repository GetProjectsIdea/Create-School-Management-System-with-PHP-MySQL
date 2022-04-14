<?php

include_once('../controller/config.php');
$id=$_GET["id"];
$sql = "SELECT * FROM teacher WHERE id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$row1=array($row['id'],$row['full_name'],$row['i_name'],$row['address'],$row['gender'],$row['phone'],$row['email'],$row['image_name'],$row['reg_date']);
echo json_encode($row1);//MSK-00117 - Ajax Response Json

?>	