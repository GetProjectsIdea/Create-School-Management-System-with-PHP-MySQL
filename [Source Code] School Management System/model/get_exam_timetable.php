<?php
include_once('../controller/config.php');
$id=$_GET["id"];

$sql = "select exam_timetable.id as ett_id,exam_timetable.day as ett_day,subject.id as s_id, class_room.id as c_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime
		from exam_timetable
		inner join subject
		on exam_timetable.subject_id=subject.id 
		inner join class_room
		on exam_timetable.classroom_id=class_room.id
		where exam_timetable.id=$id";
		
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$res=array($row['ett_id'],$row['ett_day'],$row['s_id'],$row['c_id'],$row['ett_stime'],$row['ett_etime']);
echo json_encode($res);//MSK-000134

?>	