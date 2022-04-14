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

$sql="select * from student where index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
?>                   
 
			<h3 class="box-title"><?php echo $name; ?> Payment History</h3>
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
$desc1='';

$sql1="select * from student where index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id'];

$sql="select * from student_payment where index_number='$index'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		$desc=$row['_status'];
		
		if($desc == 'Monthly Fee1'){
			$desc = 'Monthly Fee';
		}
		
?>   
              		<tr>
                    	<td><?php echo $count; ?></td>
   <!--MSK-000115-td1--><td id="td_year_<?php echo $count; ?>"><?php echo $row['year']; ?></td>
   <!--MSK-000115-td2--><td id="td_month_<?php echo $count; ?>"><?php echo $row['month']; ?></td>
   <!--MSK-000115-td3--><td id="td_status_<?php echo $count; ?>"><?php echo $desc; ?></td>
   <!--MSK-000115-td4--><td id="td_paid_<?php echo $count; ?>"><?php echo $row['paid']; ?></td>
              			<td id="td_date_<?php echo $count; ?>"><?php echo $row['date']; ?></td>
                        <td> 
<!--MSK-00102-->                                                
<a href="#" onClick="showModal3(this)" id="aView_details_<?php echo $count; ?>" class="btn btn-info btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>">View Details</a>
<a href="#" onClick="showModal4(this)" id="aView_invoice_<?php echo $count; ?>" class="btn btn-success btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['_status']; ?>,<?php echo $row['paid']; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>,<?php echo $row['date']; ?>" >View Invoice</a>
                        </td>
                     </tr>
<?php } } ?>
				</tbody>
			</table>
		</div><!-- ./box-body -->
	</div><!-- ./box -->
</div> 