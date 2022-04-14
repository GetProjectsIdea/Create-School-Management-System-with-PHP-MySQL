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
if(isset($_GET["do"])&&($_GET["do"]=="show_exam_Timetable")){
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	
$sql="select name from grade where id='$grade_id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$sql1="select name from exam where id='$exam_id'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
?>                
        	
            <h3 class="box-title"><?php echo $row['name']." - ". $row1['name']; ?> Exam Timetable</h3>
<?php } ?>
		</div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table class="table table-bordered table-striped">
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
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql2="SELECT 
	   DISTINCT start_time,end_time
       FROM
          exam_timetable
       WHERE
          grade_id='$grade_id' and  exam_id='$exam_id' 
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
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];		

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Sunday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
		
?>    	
                      
					   		<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                       	
<?php } } ?>
	
						</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Monday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
?>    	
							<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                           
<?php } } ?>
						</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Tuesday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
?>    	
							<?php echo $row['s_name']; ?><br>
                        	<?php echo $row['c_name']; ?><br>
                    
<?php  } } ?>
    					</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Wednesday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){ 
?>    	
							<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
<?php } } ?>
    					</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Thursday'";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
?>    	
							<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
<?php } } ?>
    					</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Friday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
?>    	
                     	
							<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                           
                     	
<?php  } } ?>
    					</td>
						<td>
<?php 
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];	

$sql="select exam_timetable.id as ett_id,exam_timetable.start_time as ett_stime,exam_timetable.end_time as ett_etime, subject.name as s_name, class_room.name as c_name
      from exam_timetable
	  inner join subject
	  on exam_timetable.subject_id=subject.id
	  inner join class_room
	  on exam_timetable.classroom_id=class_room.id
      where exam_timetable.start_time='$s_time' and exam_timetable.end_time='$e_time' and exam_timetable.grade_id='$grade_id' and exam_timetable.exam_id='$exam_id' and exam_timetable.day='Saturday'";
	 
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){
	
?>    	
							<?php echo $row['s_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
<?php }}?>
    					</td>
					</tr>
<?php }?>                 
				</tbody>
			</table>
    	</div><!-- /.box-body -->	
	</div><!-- /.box -->
</div><!-- /.col-md-10 -->
        