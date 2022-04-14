<?php
include_once('../controller/config.php');
$id=$_GET["event_id"];

$sql = "SELECT * FROM events WHERE id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$row1=array($row['id'],$row['title'],$row['note'],$row['color'],$row['category_id'],$row['grade_id'],$row['start_date_time'],$row['end_date_time'],$row['creator_type']);

echo json_encode($row1);//MSK-00117 

?>	