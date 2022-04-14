<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-md-7">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">My Student</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                	<th class="col-md-1">ID</th>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-7">Action</th>
                </thead>
                <tbody>
<?php
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];
$my_index=$_GET['my_index'];
$year=$_GET['year'];
	
$sql="SELECT * FROM teacher WHERE index_number='$my_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);	  	  
$teacher_id=$row['id'];	

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$teacher_id' AND grade_id='$grade_id'";
$result1=mysqli_query($conn,$sql1);

while($row1=mysqli_fetch_assoc($result1)){
	$sr_id=$row1['id'];
	
	$sql2="select student.i_name as std_name,student.id as std_id,student.index_number as std_index
           from student_subject
	       inner join student
	       on student_subject.index_number=student.index_number
	       where student_subject.year='$year' and student_subject.sr_id='$sr_id'";	
	   		  
	$result2=mysqli_query($conn,$sql2);
	$count=0;
	if(mysqli_num_rows($result2) > 0){
		while($row2=mysqli_fetch_assoc($result2)){
			$count++;
			$std_index=$row2["std_index"];
					
?>   
          			<tr>
                		<td><?php echo $count; ?></td>
                    	<td id="td1_<?php echo $row2['std_id']; ?>">
                    		<a href="#modalviewform" onClick="studentProfile('<?php echo $row2["std_index"]; ?>')" class="" data-toggle="modal"><?php echo $row2['std_name']; ?></a>
                    	</td>
                    	<td> 

<?php
$sql3="SELECT * FROM student_exam WHERE index_number='$std_index' AND exam_id='$exam_id' AND year='$year'";
$result3=mysqli_query($conn,$sql3);
			
if(mysqli_num_rows($result3) > 0){
	
	echo '<a href="#" class="btn btn-primary btn-xs " onClick="showModalViewExam('.$exam_id.','.$year.','.$std_index.')" >View Exam Marks</a>';

}else{
	
	echo '<a href="#" class="btn btn-primary btn-xs disabled" onClick="showModalViewExam('.$exam_id.','.$year.','.$std_index.')" >View Exam Marks</a>';
	
}

?>			

                   		</td>
                	</tr>
<?php } } } ?>
           		</tbody>
        	</table>	
     	</div><!-- /.box-body -->           
	</div><!-- /.box-->
</div>