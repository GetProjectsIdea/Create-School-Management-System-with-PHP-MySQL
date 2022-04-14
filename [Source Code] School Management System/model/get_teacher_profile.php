<?php

include_once('../controller/config.php');
$my_index=$_GET["my_index"];

$sql = "SELECT * FROM teacher WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$email=$row['email'];

$sql1="SELECT * FROM user WHERE email='$email'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);

$row2=array($row['id'],$row['full_name'],$row['i_name'],$row['gender'],$row['address'],$row['phone'],$row['email'],$row['image_name'],$row1['email'],$row1['password']);
echo json_encode($row2);//MSK-00106

?>	