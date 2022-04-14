<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewAllDPayment" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-7">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-orange">
                            <button type="button" class="close" onClick="countEquel0()" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="panel-title">All Due Payments</h4>
                        </div>
                        <div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class=" col-md-12"> 
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-3">Name</th>
                                            <th class="col-md-1">Year</th>
                                            <th class="col-md-2">Month</th>
                                            <th class="col-md-2">Date</th>
                                            <th class="col-md-1">Action</th>
                                        </thead>
                                        <tbody id="tBody">
<?php
include_once('../controller/config.php');

$sql="select student.index_number as std_index,student.i_name as std_name,payment_notifications.year as due_year,payment_notifications.month as due_month,payment_notifications.date as due_date
	  from payment_notifications
	  inner join student
	  on payment_notifications.index_number=student.index_number
	  where payment_notifications._status='1'";

$result=mysqli_query($conn,$sql);
$count = 0;

while($row=mysqli_fetch_assoc($result)){
	$count++;
	$std_index=$row['std_index'];
	$std_name=$row['std_name'];
	$due_year=$row['due_year'];
	$due_month=$row['due_month'];
	$due_date=$row['due_date'];

?> 
    
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td>
                                                	<a href="#" onClick="studentProfile('<?php echo $std_index; ?>')">
														<?php echo $std_name; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $due_year; ?></td>
                                                <td><?php echo $due_month; ?></td>
                                                <td><?php echo $due_date; ?></td>
                                                <td>
 <a href="#"  class="btn btn-xs btn-info" onClick="viewNotifications('<?php echo $std_index; ?>','<?php echo $due_month; ?>','<?php echo $due_year; ?>')">View Details</a>                                             
                                                </td>
                                            </tr>
<?php  } ?>                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--/.panel-body -->
                    </div><!--/. panel--> 
            	</div>        
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal --> 