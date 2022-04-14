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
        	<h3 class="box-title">All Teacher</h3>
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
$sql="SELECT * FROM teacher";
$result=mysqli_query($conn,$sql);
$count = 0;
$cant_remove1=0;
$cant_remove2=0;
$cant_remove3=0;
$cant_remove4=0;
$cant_remove5=0;
$cant_remove6=0;
$cant_remove7=0;
$cant_remove8=0;
$cant_remove9=0;
$cant_remove10=0;

if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
	$count++;
	$id=$row['id'];
	$index=$row['index_number'];

?>   
    
               		<tr>
                    	<td><?php echo $count; ?></td>
                        <td id="td1_<?php echo $row['id']; ?>"><?php echo $row['i_name']; ?></td>
						<td>   
                                
<?php

$sql1="SELECT * FROM subject_routing WHERE teacher_id='$id'";	
   
$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0){
	$cant_remove1=1;
}else{
	$cant_remove1=0;
}

$sql2="SELECT * FROM timetable WHERE teacher_id='$id'";	
   
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) > 0){
	$cant_remove2=1;
}else{
	$cant_remove2=0;
}


$sql3="SELECT * FROM teacher_attendants WHERE index_number='$index'";	
   
$result3=mysqli_query($conn,$sql3);

if(mysqli_num_rows($result3) > 0){
	$cant_remove3=1;
}else{
	$cant_remove3=0;
}

$sql4="SELECT * FROM teacher_salary WHERE index_number='$index'";	
   
$result4=mysqli_query($conn,$sql4);

if(mysqli_num_rows($result4) > 0){
	$cant_remove4=1;
}else{
	$cant_remove4=0;
}

$sql5="SELECT * FROM teacher_salary_history WHERE index_number='$index'";	
   
$result5=mysqli_query($conn,$sql5);

if(mysqli_num_rows($result5) > 0){
	$cant_remove5=1;
}else{
	$cant_remove5=0;
}

$sql6="SELECT * FROM my_friends WHERE friend_index='$index'";	
   
$result6=mysqli_query($conn,$sql6);

if(mysqli_num_rows($result6) > 0){
	$cant_remove6=1;
}else{
	$cant_remove6=0;
}


$sql7="SELECT * FROM online_chat WHERE user_index='$index' AND user_type='Teacher'";	
   
$result7=mysqli_query($conn,$sql7);

if(mysqli_num_rows($result7) > 0){
	$cant_remove7=1;
}else{
	$cant_remove7=0;
}

$sql8="SELECT * FROM petty_cash WHERE received_by='$index' AND received_type='Teacher'";	
   
$result8=mysqli_query($conn,$sql8);

if(mysqli_num_rows($result8) > 0){
	$cant_remove8=1;
}else{
	$cant_remove8=0;
}

$sql9="SELECT * FROM petty_cash_history WHERE received_by='$index' AND received_type='Teacher'";	
   
$result9=mysqli_query($conn,$sql9);

if(mysqli_num_rows($result9) > 0){
	$cant_remove9=1;
}else{
	$cant_remove9=0;
}


$sql10="SELECT * FROM events WHERE create_by='$index' AND creator_type='Teacher'";	
   
$result10=mysqli_query($conn,$sql10);

if(mysqli_num_rows($result10) > 0){
	$cant_remove10=1;
}else{
	$cant_remove10=0;
}

if($cant_remove1 > 0 || $cant_remove2 > 0 || $cant_remove3 > 0 || $cant_remove4 > 0 || $cant_remove5 > 0 || $cant_remove6 > 0 || $cant_remove7 > 0 || $cant_remove8 > 0 || $cant_remove9 > 0 || $cant_remove10 > 0){
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" onClick="addSalary(this)" class="btn btn-success btn-xs"  data-id="'.$index.','.$id.'">Add Salary</a>';
	echo ' <a href="#" onClick="viewPayments(this)" class="btn btn-info btn-xs"  data-id="'.$index.'">View Payments</a>';
	
}else{
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="'.$id.'">Delete</a>';
	echo ' <a href="#" onClick="addSalary(this)" class="btn btn-success btn-xs"  data-id="'.$index.','.$id.'">Add Salary</a>';
	echo ' <a href="#" onClick="viewPayments(this)" class="btn btn-info btn-xs"  data-id="'.$index.'">View Payments</a>';
	
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