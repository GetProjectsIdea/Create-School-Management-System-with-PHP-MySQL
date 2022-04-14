<?php
include_once('../controller/config.php');
$id=$_GET["id"];

$sql = "select subject_routing.id as sr_id,subject_routing.fee as s_fee, grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
		from subject_routing
		inner join grade
		on subject_routing.grade_id=grade.id 
		inner join subject
		on subject_routing.subject_id=subject.id 
		inner join teacher
		on subject_routing.teacher_id=teacher.id
		where subject_routing.id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['sr_id'],$row['g_name'],$row['s_name'],$row['t_name'],$row['s_fee']);
echo json_encode($res);//MSK-00106

?>	