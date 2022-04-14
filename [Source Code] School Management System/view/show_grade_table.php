<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-xs-7">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">All Grade</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                	<th>ID</th>
                    <th>Grade</th>
                    <th>Admission Fee($)</th>
                    <th>Hall Charge(%)</th>
                    <th>Action</th>
               	</thead>
                <tbody>
<?php
include_once('../controller/config.php');

$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
$count = 0;
$cant_remove1=0;
$cant_remove2=0;
$cant_remove3=0;
$cant_remove4=0;
$cant_remove5=0;
$cant_remove6=0;
$cant_remove7=0;

if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
	$count++;
	$id=$row['id'];
?>   
               		<tr>
                    	<td><?php echo $count; ?></td>
   <!--MSK-000115-td1--><td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
   <!--MSK-000115-td2--><td id="td2_<?php echo $row['id']; ?>"><?php echo $row['admission_fee']; ?></td>
   <!--MSK-000115-td3--><td id="td3_<?php echo $row['id']; ?>"><?php echo $row['hall_charge']; ?></td>
                        <td> 

<?php
$sql1="SELECT * FROM exam_timetable WHERE grade_id='$id'";	
   
$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0){
	$cant_remove1=1;
}else{
	$cant_remove1=0;
}

$sql2="SELECT * FROM student_exam WHERE grade_id='$id'";	
   
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) > 0){
	$cant_remove2=1;
}else{
	$cant_remove2=0;
}

$sql3="SELECT * FROM student_grade WHERE grade_id='$id'";	
   
$result3=mysqli_query($conn,$sql3);

if(mysqli_num_rows($result3) > 0){
	$cant_remove3=1;
}else{
	$cant_remove3=0;
}

$sql4="SELECT * FROM student_payment_history WHERE grade_id='$id'";	
   
$result4=mysqli_query($conn,$sql4);

if(mysqli_num_rows($result4) > 0){
	$cant_remove4=1;
}else{
	$cant_remove4=0;
}

$sql5="SELECT * FROM subject_routing WHERE grade_id='$id'";	
   
$result5=mysqli_query($conn,$sql5);

if(mysqli_num_rows($result5) > 0){
	$cant_remove5=1;
}else{
	$cant_remove5=0;
}

$sql6="SELECT * FROM teacher_salary_history WHERE grade_id='$id'";	
   
$result6=mysqli_query($conn,$sql6);

if(mysqli_num_rows($result6) > 0){
	$cant_remove6=1;
}else{
	$cant_remove6=0;
}

$sql7="SELECT * FROM timetable WHERE grade_id='$id'";	
   
$result7=mysqli_query($conn,$sql7);

if(mysqli_num_rows($result7) > 0){
	$cant_remove7=1;
}else{
	$cant_remove7=0;
}


if($cant_remove1 > 0 || $cant_remove2 > 0 || $cant_remove3 > 0 || $cant_remove4 > 0 || $cant_remove5 > 0 || $cant_remove6 > 0 || $cant_remove7 > 0 ){
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#modalMRangeGrade" onClick="showModal1(this)" class="btn btn-warning btn-xs" data-id="'.$id.'" data-toggle="modal">View eMark</a>';
	
}else{
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="'.$id.'">Delete</a>';
	echo ' <a href="#modalMRangeGrade" onClick="showModal1(this)" class="btn btn-warning btn-xs" data-id="'.$id.'" data-toggle="modal">View eMark</a>';
	
}

?>   

                        </td>
                    </tr>
<?php } } ?>
                </tbody>
			</table>	
    	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>
    