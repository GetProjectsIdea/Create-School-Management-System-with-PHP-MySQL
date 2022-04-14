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
                 		<a href="#modalInsertform" onClick="" class="btn btn-success btn-sm pull-right" data-toggle="modal">Add <span class="glyphicon glyphicon-plus"></span></a><!-- MSK-00094-->
                  		<h3 class="box-title">Exam Routing</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!-- MSK-00093-->
                		<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Grade</th>
                                <th class="col-md-1">Exam</th>
                                <th class="col-md-4">Subject</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                        	<tbody>
<?php
include_once('../controller/config.php');


$sql="SELECT 
	  DISTINCT grade_id,exam_id,subject_id
	  FROM
  		exam_routing  
	  ORDER BY
  		grade_id";	  
	  
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		
		$g_id=$row['grade_id'];
		$e_id=$row['exam_id'];
		$s_id=$row['subject_id'];
		
		$sql1="select distinct exam_routing.id as exr_id,grade.name as g_name,exam.name as e_name,subject.name as s_name
		from exam_routing
		inner join grade
		on exam_routing.grade_id=grade.id
		inner join exam
		on exam_routing.exam_id=exam.id
		inner join subject
		on exam_routing.subject_id=subject.id
		where exam_routing.grade_id='$g_id' and exam_routing.exam_id='$e_id' and exam_routing.subject_id='$s_id'";
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		
		
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row1['exr_id']; ?>"><?php echo $row1['g_name']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row1['exr_id']; ?>"><?php echo $row1['e_name']; ?></td>
               <!--MSK-000115-td3--><td id="td3_<?php echo $row1['exr_id']; ?>"><?php echo $row1['s_name']; ?></td>
                                    <td> 
<!--MSK-00102-->                                                
<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="<?php echo $g_id; ?>,<?php echo $e_id; ?>,<?php echo $s_id; ?>" data-toggle="modal">Edit</a>
<!--MSK-00121-->
<a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="<?php echo $g_id; ?>,<?php echo $e_id; ?>,<?php echo $s_id; ?>">Delete</a>
                               		</td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div>