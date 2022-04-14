<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewPayment" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-6">
                    <div class="panel"><!--panel bg-maroon--> 
                        <div class="panel-heading bg-aqua-active">
<?php
include_once("../controller/config.php");

$index=$_GET['index'];
$sql="SELECT * FROM student WHERE index_number='$index'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
	
$image_name=$row['image_name'];
$full_name=$row['full_name'];
$i_name=$row['i_name'];
$address=$row['address'];
$phone=$row['phone'];
$email=$row['email'];

?>                    
							<button type="button"  class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        	<h4 class="panel-title" id="hname"><?php echo $i_name; ?></h4>
            			</div>
            			<div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class="col-md-3"> 
                                    <img id="photo2" alt="User Pic" src="../<?php echo $image_name; ?>" class="img-circle img-responsive"> 
                                </div>
                                <div class=" col-md-9"> 
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>Full Name</td>
                                                <td id="full_name3"> <?php echo $full_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td id="address3"><?php echo $address; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td id="address3"><?php echo $phone; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td id="address3"><?php echo $email; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Last Payment</td>
<?php
include_once("../controller/config.php");
    
$index=$_GET['index'];
$page=$_GET['page'];
$last_paid=0;
$last_month= date('F', strtotime('-1 months'));
$current_month=date('F');    
    
$sql1="SELECT paid
       FROM student_payment
       WHERE index_number='$index' and month='$last_month' and (_status='Monthly Fee' or _status='Monthly Fee1')";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
        
$last_paid=$row1['paid'];
$last_paid = number_format($last_paid, 2, '.', '');
    
?>                                            
                                                <td id="lastMonth"><?php echo $last_month;  ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Fee</td>
                                                
                                                <td id="mFee_lMonth">$<?php echo $last_paid;  ?></td>
                                              
                                            </tr>
                                            <tr>
                                                <td>Paid</td>
                                                <td id="lastPaid">$<?php echo $last_paid;  ?></td>
                                            </tr>
                                            <tr>
                                                <td>Current Month</td>
                                                <td><?php echo $current_month; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Fee</td>
<?php
include_once('../controller/config.php');

$current_year=date('Y'); 
$current_month=date('F'); 
$monthly_fee=0;
$index=$_GET['index'];

$sql="select subject_routing.fee as s_fee 
      from student_subject
	  inner join subject_routing
	  on student_subject.sr_id=subject_routing.id 
      where student_subject.index_number='$index' and year='$current_year'";

$result=mysqli_query($conn,$sql);
    
if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)){
        
		$monthly_fee+=$row['s_fee'];
		$monthly_fee = number_format($monthly_fee, 2, '.', '');
	}
	
}
?>                                            
                                                <td id="current_mFee">$<?php echo $monthly_fee ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Paid</td>
<?php
include_once("../controller/config.php");
$index=$_GET['index'];
$paid_current_month=0;
$current_month= date('F');
    
$sql1="SELECT paid
       FROM student_payment
       WHERE index_number='$index' and month ='$current_month' and (_status='Monthly Fee' or _status='Monthly Fee1')";

$result1=mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_assoc($result1);
	$paid_current_month=$row1['paid'];

$due = $monthly_fee - $paid_current_month;
$due = number_format($due, 2, '.', '');
    
?>                                            
                                                <td id="currentPaid"> $<?php echo $paid_current_month; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Due Amount </td>
                                                
                                                <td id="dueAmount">$<?php echo $due; ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--/.panel-body -->
                		<div class="panel-footer bg-gray-light"><!--panel-footer-->
                    		<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        	<span class="pull-right">
                        		<input type="hidden" id="index_number" value="<?php echo $index; ?>">
                                <input type="hidden" id="cpage" value="<?php echo $page; ?>">
                            	<button id="btnPaid" onClick="addPayment(this)" value="" class="btn btn-success" >+Add Payment </button>
                        	</span>
                    	</div><!--/.panel-footer-->
                    </div><!--/. panel--> 
            	</div>
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal --> 

