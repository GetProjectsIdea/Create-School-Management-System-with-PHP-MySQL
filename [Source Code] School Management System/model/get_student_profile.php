<?php
include_once('../controller/config.php');
$my_index=$_GET["my_index"];

$sql = "SELECT * FROM student WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$email=$row['email'];

$sql1="SELECT * FROM user WHERE email='$email'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);

$sql2="SELECT * FROM parents WHERE my_son_index='$my_index'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);

$res=array($row['id'],$row['full_name'],$row['i_name'],$row['gender'],$row['address'],$row['phone'],$row['email'],$row['image_name'],$row2['i_name'],$row2['address'],$row2['phone'],$row2['email'],$row1['email'],$row1['password'],$my_index);

echo json_encode($res);//MSK-00106



?>	