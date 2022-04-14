<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-xs-8">
	<div class="box">
    	<div class="box-header">
        	<h3 class="box-title">All Classroom</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                	<th>ID</th>
                    <th>Name</th>
                   	<th>Student Count</th>
                    <th>Action</th>
                </thead>
                <tbody>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM class_room";
$result=mysqli_query($conn,$sql);
$count = 0;
$cant_remove=0;
$cant_remove1=0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
	$count++;
	$id=$row['id'];
?>   
    
                	<tr>
                    	<td><?php echo $count; ?></td>
   <!--MSK-000115-td1--><td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
   <!--MSK-000115-td2--><td id="td2_<?php echo $row['id']; ?>"><?php echo $row['student_count']; ?></td>
                    	<td> 

<?php
$sql1="SELECT * FROM timetable WHERE classroom_id='$id'";	
   
$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0){
	$cant_remove=1;
}else{
	$cant_remove=0;
}



$sql2="SELECT * FROM exam_timetable WHERE classroom_id='$id'";	   
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) > 0){
	$cant_remove1=1;
}else{
	$cant_remove1=0;
}


if($cant_remove > 0 ||  $cant_remove1 > 0){
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-warning btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	
}else{
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="'.$id.'">Delete</a>';
	
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