<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="row" id="table1">
	<div class="col-md-10">
    	<div class="box">
        	<div class="box-header">
            	<a href="#modalInsertform" onClick="showModal(this)" class="btn btn-success btn-sm pull-right" data-id="<?php echo $row["id"]; ?>" data-toggle="modal">Add <span class="glyphicon glyphicon-plus"></span></a>
                 <h3 class="box-title">All Teacher</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
                	<thead>
                    	<th class="col-md-1">ID</th>
                        <th class="col-md-1">Grade</th>
                        <th class="col-md-1">Subject</th>
                        <th class="col-md-4">Teacher</th>
                        <th class="col-md-1">Fee($)</th>
                        <th class="col-md-2">Action</th>
                     </thead>
                     <tbody>
<?php
include_once('../controller/config.php');

$sql="select subject_routing.id as sr_id,subject_routing.fee as s_fee,grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
	  from subject_routing
	  inner join grade
	  on subject_routing.grade_id=grade.id 
	  inner join subject
	  on subject_routing.subject_id=subject.id 
	  inner join teacher
	   on subject_routing.teacher_id=teacher.id";

$result=mysqli_query($conn,$sql);
$count = 0;
$current_date_number=date("d");

if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		
		$count++;
		$sr_id=$row['sr_id'];
?>   
    
                        <tr>
                           	<td><?php echo $count; ?></td>
                            <td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['g_name']; ?></td>
                            <td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['s_name']; ?></td>
                            <td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['t_name']; ?></td>
                            <td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['s_fee']; ?></td>
                            <td>             
<?php
$sql1="SELECT * FROM student_subject WHERE sr_id='$sr_id'";

$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0) {
	
	echo '<a href="#" id="edit1_sfee_'.$count.'" onClick="editSubjectFee(this)" class="btn btn-warning btn-xs cant-edit" data-id="'.$sr_id.','.$count.','.$row["s_fee"].'" >Edit Fee</a>';

}else{
	
	echo '<a href="#modalUpdateform" id="edit_sfee_'.$count.'" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$sr_id.','.$count.'" data-toggle="modal">Edit</a>';  
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs" id="delete_sfee_'.$count.'" data-id="'.$sr_id.'">Delete</a>'; 
                                            	
}

if($current_date_number > 5){
	//disabled
	echo "<script>$('.cant-edit').addClass('disabled');</script>";
}

?>       

                        	</td>
                    	</tr>
<?php } } ?>
                	</tbody>
				</table>	
    		</div>
     	</div>
	</div>
</div>

        

       
       

