<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-md-8">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">My Student</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                	<th class="col-md-1">ID</th>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-4">Action</th>
                </thead>
                <tbody>
<?php
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$month_id=$_GET['month'];
$year=$_GET['year'];
	
$sql="select student.i_name as std_name,student.id as std_id,student.index_number as std_index 
      from student
	  inner join student_grade
	  on student.index_number=student_grade.index_number
	  where student_grade.grade_id='$grade_id' and student._status='' and student_grade.year='$year'";
	  	  
$result=mysqli_query($conn,$sql);
$count=0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		$std_index=$row["std_index"];
?>   
          			<tr>
                		<td><?php echo $count; ?></td>
                    	<td id="td1_<?php echo $row['std_id']; ?>">
                    		<a href="#modalviewform" onClick="studentProfile('<?php echo $row["std_index"]; ?>')" class="" data-toggle="modal"><?php echo $row['std_name']; ?></a>
                    	</td>
                    	<td> 

	
<a href="#" class=" btn btn-primary btn-xs" onClick="showAttendance('<?php echo $year; ?>','<?php echo $month_id; ?>','<?php echo $std_index; ?>')"  >View Attendance</a>
	
                    	</td>
                	</tr>
<?php } }  ?>
           		</tbody>
        	</table>	
     	</div><!-- /.box-body -->           
	</div><!-- /.box-->
</div>