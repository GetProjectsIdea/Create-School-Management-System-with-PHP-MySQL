<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-md-10">
	<div class="box">
    	<div class="box-header">
<?php 
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="show_Timetable")){
$id=$_GET['grade'];	
$sql="select name from grade where id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>                
        	<a href="#" onClick="showModal(this)" class="btn btn-success btn-sm pull-right" data-id="<?php echo $id; ?>">Add <span class="glyphicon glyphicon-plus"></span></a><!--MSK-000113-->
            <h3 class="box-title">Timetable - <?php echo $row['name']; ?></h3>
<?php } ?>
		</div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead style="color:white; background-color:#666;">
                	<th class="col-md-1">Time</th>
                    <th class="col-md-1">Sunday</th>
                    <th class="col-md-1">Monday</th>
                    <th class="col-md-1">Tuesday</th>
                    <th class="col-md-1">Wednesday</th>
                    <th class="col-md-1">Thursday</th>
                    <th class="col-md-1">Friday</th>
                    <th class="col-md-1">Saturday</th>
                 </thead>
                 <tbody>
<?php
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql2="SELECT 
DISTINCT start_time,end_time
FROM
  timetable
WHERE
  grade_id='$id'  
ORDER BY
  start_time";
$result2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_assoc($result2)){
	$s_time=$row2['start_time'];
	$e_time=$row2['end_time'];
	
?>    
                 	<tr id="<?php echo $s_time; ?>_<?php echo $e_time; ?>" >
                    	<th  style="color:white; background-color:#666;">
                        	<span id="spanSTime_<?php echo $row2['id']; ?>" data-id="<?php echo $s_time; ?>"><?php echo $s_time; ?></span> - 		
                            <span id="spanETime_<?php echo $row2['id']; ?>" data-id="<?php echo $e_time; ?>"><?php echo $e_time; ?></span>
                        </th>
                        <td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Sunday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 1#
	while($row=mysqli_fetch_assoc($result)){ // while loop 1#
		
?>    	
                      
					   		<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                       		<a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
  	 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                       	
<?php }//end of the while loop 1# ?>
	
						</td>
<?php	
}else{	// 1#

	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Sunday,'.$id.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday

} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as   t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Monday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 2#
	while($row=mysqli_fetch_assoc($result)){ // while loop 2#
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Monday-->  
  	 <!--MSK-00150-Monday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                      	
<?php } // end of the while loop 2# ?>
						</td>
<?php 
}else{// 2#	

	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Monday,'.$id.'" data-toggle="modal">Add          <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Monday 
	
} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Tuesday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 3#
	while($row=mysqli_fetch_assoc($result)){ // while loop 3#
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                        	<?php echo $row['c_name']; ?><br>
                        	<a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Tuesday-->  
  	<!--MSK-00150-Tuesday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                    
<?php  } // end of the while loop 3# ?>
    					</td>
<?php	
}else{ // 3#
		
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Tuesday,'.$id.'" data-toggle="modal">Add          <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Tuesday 
	
} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Wednesday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 4#
	while($row=mysqli_fetch_assoc($result)){ // while loop 4# 
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Wednesday-->  
  <!--MSK-00150-Wednesday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                     	
<?php } // end of the while loop 4#  ?>
    					</td>
<?php	
}else{ // 4#
		
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Wednesday,'.$id.'" data-toggle="modal">Add         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Wednesday 
	
} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Thursday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { //5#
	while($row=mysqli_fetch_assoc($result)){ // while loop 5#
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Thursday--> 
   <!--MSK-00150-Thursday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                     	
<?php } // end of the while loop 5# ?>
    					</td>
    
<?php
}else{ // 5#
		
	echo '<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Thursday,'.$id.'" data-toggle="modal">Add          <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Thursday 
	
} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Friday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 6#
	while($row=mysqli_fetch_assoc($result)){// while loop 6#
?>    	
                     	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Friday-->  
  	 <!--MSK-00150-Friday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                     	
<?php  } // end of the while loop 6#  ?>
    					</td>
<?php
}else{ // 6#
		
	echo '<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Friday,'.$id.'" data-toggle="modal">Add 		          <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Friday 
} 

?>
						<td>
<?php 
include_once('../controller/config.php');
$id=$_GET['grade'];	
$sql="select timetable.id as tt_id,timetable.start_time as tt_stime,timetable.end_time as tt_etime, subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
      where timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.grade_id='$id' and timetable.day='Saturday'";
	 
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 7#
	while($row=mysqli_fetch_assoc($result)){ // while loop 7#
	
?>    	
							<?php echo $row['s_name']; ?><br>
						    <?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Saturday-->
   <!--MSK-00150-Saturday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $id; ?>">Delete</a><br>
                     	
<?php } // end of the while loop 7#   ?>
    					</td>
<?php
}else{ // 7#	

	echo '<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Saturday,'.$id.'" data-toggle="modal">Add 		          <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Saturday
	
} 

?>								
					</tr>
<?php 
} 
?>                     
				</tbody>
			</table>
    	</div><!-- /.box-body -->	
	</div><!-- /.box -->
</div><!-- /.col-md-10 -->
        