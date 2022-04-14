<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_parents.php'); ?>
<?php include_once('sidebar3.php'); ?>

<style>

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}



</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	All Timetable
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Timetable</a></li>
            <li><a href="#">All Timetable</a></li>
    	</ol>
	</section>
    
	 <!-- table for view all records -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
                <div class="box">
                    <div class="box-header">
<?php
include_once('../controller/config.php');

$index=$_SESSION["index_number"];
$current_year=date('Y');

$sql3="SELECT * FROM parents WHERE index_number='$index'";
$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_assoc($result3);
$my_son_index=$row3['my_son_index'];

$sql="SELECT * FROM student_grade WHERE index_number='$my_son_index' and year='$current_year'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['grade_id']; 

$sql1="SELECT * FROM grade WHERE id='$id'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$name=$row1['name'];
       
        
?>        
                    <h3 class="box-title">Timetable - <?php echo $name; ?> </h3>
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

$sql1="SELECT * FROM student_grade WHERE index_number='$my_son_index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$grade=$row1['grade_id'];


$sql2="SELECT 
	   DISTINCT start_time,end_time
       FROM
          timetable
       WHERE
          grade_id='$grade'  
       ORDER BY
          start_time";
		  
$result2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_assoc($result2)){
	
	$s_time=$row2['start_time'];
	$e_time=$row2['end_time'];
		
?>    
                 	<tr>
                    	<th  style="color:white; background-color:#666;">
                        	<?php echo $s_time." - ".$e_time; ?>		
                            
                        </th>
                         <td bgcolor="#d74340" style="color:white;">
<?php 
include_once('../controller/config.php');

$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Sunday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
		
?>    	
                      
					   		<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                       		
<?php } } ?>
	
                                </td>
                                <td bgcolor="#d7cb40" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Monday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
<?php } } ?>
                                </td>
                                <td bgcolor="#40b9d7" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Tuesday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                        	<?php echo $row['c_name']; ?><br>
                        	
                    
<?php  } } ?>
                                </td>
                                <td bgcolor="#f39037" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Wednesday'";

$result=mysqli_query($conn,$sql);	  
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){  
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
<?php } }  ?>
                                </td>
                                <td bgcolor="#7e5c3e" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Thursday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){
	
?>    	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                           
<?php } } ?>
                                </td>
                                <td bgcolor="#3e447e" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Friday'";
	  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 6#
	while($row=mysqli_fetch_assoc($result)){// while loop 6#
?>    	
                     	
							<?php echo $row['s_name']; ?><br>
							<?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                     	
<?php  } } ?>
                                </td>
                                <td bgcolor="#638e3d" style="color:white;">
<?php 
include_once('../controller/config.php');
	
$sql="select subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
	  inner join subject
	  on timetable.subject_id=subject.id
	  inner join teacher
	  on timetable.teacher_id=teacher.id
	  inner join class_room
	  on timetable.classroom_id=class_room.id
	  where timetable.grade_id='$grade' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Saturday'";
	 
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { 
	while($row=mysqli_fetch_assoc($result)){ 
	
?>    	
							<?php echo $row['s_name']; ?><br>
						    <?php echo $row['t_name']; ?><br>
                            <?php echo $row['c_name']; ?><br>
                            
                     	
<?php } }  ?>
                                    </td>
                                </tr>
<?php }   ?>
					
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->	
                </div><!-- /.box -->
            </div><!-- /.col-md-10 -->
        </div>
     </section>   

<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>      
    
</div><!-- /.content-wrapper -->  
                            
<?php include_once('footer.php');?>   