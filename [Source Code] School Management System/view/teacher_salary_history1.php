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
$index=$_GET['index'];

$sql="select * from teacher where index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
?>                    
        	<h3 class="box-title"><?php echo $name; ?> Salary History</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
        <!-- MSK-00093-->
        <table id="example2" class="table table-bordered table-striped">
        	<thead>
            	<th class="col-md-1">ID</th>
                <th class="col-md-1">Year</th>
                <th class="col-md-1">Month</th>
                <th class="col-md-1">Description</th>
                <th class="col-md-1">Paid($)</th>
                <th class="col-md-1">Date</th>
                <th class="col-md-2">Action</th>
            </thead>
            <tbody>
<?php
include_once('../controller/config.php');
$index=$_GET['index'];

$sql1="select * from teacher where index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id'];

$sql="select * from teacher_salary where index_number='$index'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?>   
            	<tr>
               		 <td><?php echo $count; ?></td>
<!--MSK-000115-td1--><td id="td_year_<?php echo $count; ?>"><?php echo $row['year']; ?></td>
<!--MSK-000115-td2--><td id="td_month_<?php echo $count; ?>"><?php echo $row['month']; ?></td>
<!--MSK-000115-td3--><td id="td_status_<?php echo $count; ?>"><?php echo $row['_status']; ?></td>
<!--MSK-000115-td4--><td id="td_paid_<?php echo $count; ?>"><?php echo $row['paid']; ?></td>
               		 <td id="td_date_<?php echo $count; ?>"><?php echo $row['date']; ?></td>
                     <td> 
<!--MSK-00102-->                                                
<a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>,<?php echo $count; ?>">View Details</a>
<a href="#" onClick="showModal3(this)" class="btn btn-success btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>,<?php echo $count; ?>" >View Invoice</a>

                      </td>
                </tr>
<?php } } ?>
			</tbody>
		</table>
	</div><!-- ./box-body -->
</div><!-- ./box -->