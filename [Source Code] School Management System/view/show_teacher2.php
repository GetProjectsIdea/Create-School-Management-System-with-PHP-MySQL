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
        	<h3 class="box-title">All Teacher</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        	<table id="example1" class="table table-bordered table-striped">
            	<thead>
                	<th class="col-md-1">ID</th>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">Action</th>
                </thead>
                <tbody>
<?php
include_once('../controller/config.php');
$month_id=$_GET['month'];
$year=$_GET['year'];
	
$sql="SELECT * FROM teacher";
	  	  
$result=mysqli_query($conn,$sql);
$count=0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;

?>   
          			<tr>
                		<td><?php echo $count; ?></td>
                    	<td id="td1_<?php echo $row['id']; ?>">
                    		<a href="#modalviewform" onClick="teacherProfile('<?php echo $row["index_number"]; ?>')" class="" data-toggle="modal"><?php echo $row['i_name']; ?></a>
                    	</td>
                    	<td> 

	
<a href="#" class=" btn btn-primary btn-xs" onClick="showAttendance('<?php echo $year; ?>','<?php echo $month_id; ?>','<?php echo $row["index_number"]; ?>')"  >View Attendance</a>
	





                    	</td>
                	</tr>
<?php } }  ?>
           		</tbody>
        	</table>	
     	</div><!-- /.box-body -->           
	</div><!-- /.box-->
</div>