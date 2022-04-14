<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewSalary" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-6">
                    <div class="panel"><!--panel bg-maroon--> 
                        <div class="panel-heading bg-aqua-active">
<?php
include_once("../controller/config.php");
    
$index=$_GET['index'];
$sql="SELECT * FROM teacher WHERE index_number='$index'";
    
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
                                    <table class="table table-user-information" id="tableSdetails1">
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
$total_salary_lmonth=0;
$last_month= date('F', strtotime('-1 months'));
$current_month=date('F');    
    
$sql1="SELECT sum(paid)
       FROM teacher_salary
       WHERE index_number='$index' and month='$last_month'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
        
$total_salary_lmonth=$row1['sum(paid)'];
$total_salary_lmonth = number_format($total_salary_lmonth, 2, '.', '');
    
?>                                            
                                                <td id="lastPayment"><?php echo $last_month;  ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Total Salary</td>
                                                
                                                <td id="tSalary_lMonth">$<?php echo $total_salary_lmonth;  ?></td>
                                              
                                            </tr>
                                            <tr>
                                                <td>Paid</td>
                                                <td id="lastPaid">$<?php echo $total_salary_lmonth;  ?></td>
                                            </tr>
                                            <tr>
                                                <td>Current Month</td>
                                                <td><?php echo $current_month; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Salary</td>
<?php
include_once('../controller/config.php');
    
$id=$_GET['teacher_id'];
$current_year=date('Y'); 
$current_month=date('F'); 
$current_total = 0;
$current_total1=0;  
$current_total_salary=0;
$sql="select * from subject_routing where teacher_id='$id'";
$result=mysqli_query($conn,$sql);
    
if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)){
        $sr_id=$row['id'];
		$subject_fee=$row['fee'];
		$subject_id=$row['subject_id'];
		$grade_id=$row['grade_id'];
	
		$sql2="SELECT count(index_number)
               FROM student_subject
               WHERE sr_id = '$sr_id' and _status=''";
                
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
		$student_count=$row2['count(index_number)'];
		
		$sql3="SELECT * FROM grade WHERE id ='$grade_id'";
                
        $result3=mysqli_query($conn,$sql3);
        $row3=mysqli_fetch_assoc($result3);
		$hall_charge=$row3['hall_charge'];
		
		$subtotal= $student_count*$subject_fee;
		$subtotal1=$subtotal - ($subtotal*$hall_charge/100);
		$current_total+=$subtotal1;
	
	}
	
}

$sql1="SELECT 
	   DISTINCT index_number
       FROM
  	      student_subject
	   WHERE
  		  _status='leave' and year='2017'  
	   ORDER BY
  		  index_number";

$result1=mysqli_query($conn,$sql1);
if(mysqli_num_rows($result1) > 0){
	while($row1=mysqli_fetch_assoc($result1)){
		
		$index_number=$row1['index_number'];
			
		$sql2="SELECT sum(subtotal)
           	   FROM student_payment_history
               WHERE index_number='$index_number' and teacher_id='$id' and year='$current_year' and month ='$current_month' and _status='Monthly_Fee'";
			
		$result2=mysqli_query($conn,$sql2);
			
		if(mysqli_num_rows($result2) > 0){
			
			$row2=mysqli_fetch_assoc($result2);
			$subtotal1=$row2['sum(subtotal)'];
			$current_total1+=$subtotal1;
				
		}
		
	}		
		
				
}
		
    $current_total_salary=$current_total+$current_total1;
	$current_total_salary = number_format($current_total_salary, 2, '.', '');
	
?>                                            
                                                <td id="currentSalary">$<?php echo $current_total_salary; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Paid</td>
<?php
include_once("../controller/config.php");
$index=$_GET['index'];
$total_salary=0;
$current_month= date('F');
    
$sql1="SELECT sum(paid)
       FROM teacher_salary
       WHERE index_number='$index' and month ='$current_month'";
    
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
        
$paid_current_month=$row1['sum(paid)'];
$balance = $current_total_salary - $paid_current_month;
    
$balance = number_format($balance, 2, '.', '');
    
?>                                            
                                                <td id="currentPaid"> $<?php echo $paid_current_month; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Due Amount </td>
                                                
                                                <td id="dueAmount">$<?php echo $balance; ?> </td>
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
                                <input type="hidden" id="teacher_id" value="<?php echo $id; ?>">
                                <input type="hidden" id="cPage" value="<?php echo $page; ?>">
                                <button id="btnPaid" onClick="addSalary1(this)" value="" class="btn btn-success" >+Add Payment </button>
                                
                            </span>
                        </div><!--/.panel-footer-->
                    </div><!--/. panel--> 
            	</div>
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal --> 

