<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewPayment1" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog1"><!--modal-dialog -->  
		<div class="container modal-content2"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-10">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-aqua-active">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<?php
include_once('../controller/config.php');
$index=$_GET['index'];
$sql="SELECT * FROM student WHERE index_number='$index'"; 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
?>                           
                            <h4 class="panel-title" id="tName"><?php echo $name; ?></h4>
                            
                        </div>
                        <div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class=" col-md-12 table1-responsive"> 
                                        <h3>Monthly Fee For This Month</h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th class="col-md-1">#</th>
                                            <th class="col-md-1">Grade</th>
                                            <th class="col-md-1">Subject</th>
                                            <th class="col-md-1">Subject Fee($)</th>
                                            <th class="col-md-1 ">Total($)</th>
                                        </thead>
                                        <tbody id="tBody">
<?php
include_once('../controller/config.php');
$index=$_GET['index'];
$page=$_GET['page'];
$current_month=date('F');
$current_year=date('Y');

$count = 0;
$total = 0;
$s_count=0;
$student_count1=0;  
$subject_fee1=0;     
$inv_number=0;

$sql1="SELECT * FROM student_payment_history ORDER BY id DESC LIMIT 1";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$last_inv_number=$row1['invoice_number'];
$inv_number=$last_inv_number+1;

$sql="select grade.name as g_name,subject.name as s_name,subject_routing.fee as sr_fee,subject_routing.id as sr_id,subject_routing.grade_id as g_id,subject_routing.subject_id as s_id
	  from student_subject
      inner join subject_routing
	  on student_subject.sr_id=subject_routing.id
      inner join grade
      on subject_routing.grade_id=grade.id
      inner join subject
      on subject_routing.subject_id=subject.id
      where student_subject.index_number='$index' and student_subject._status='' and student_subject.year='$current_year'";
	        
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
            
            $sr_id= $row['sr_id'];
            $grade_id=$row['g_id'];
			$subject_id=$row['s_id'];
					    
			$total+=$row['sr_fee'];
			$total = number_format($total, 2, '.', '');
			$count++;
			
?> 
    
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['g_name']; ?></td>
                                                <td><?php echo $row['s_name']; ?></td>
                                                <td><?php echo $row['sr_fee']; ?></td>
                                                <td id="tSalary"><?php echo $total; ?></td>
                                            </tr>
<?php } } ?>                                        
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" col-md-7 table2-responsive">
                                        <h3>Last Payment</h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-1">Description</th>
                                            <th class="col-md-1">Amount($)</th>
                                            <th class="col-md-1">Month</th>
                                            <th class="col-md-2">Date</th>
                                        </thead>
                                        <tbody>
<?php
include_once("../controller/config.php");
$index=$_GET['index'];
      
$sql1="SELECT * FROM student_payment WHERE index_number='$index' and _status='Monthly Fee' ORDER BY id DESC LIMIT 1";

$result1=mysqli_query($conn,$sql1);
if(mysqli_num_rows($result1) > 0){
	$row1=mysqli_fetch_assoc($result1);
	 
	$desc=$row1['_status'];
	$paid=$row1['paid'];
    $month=$row1['month'];
	$date=$row1['date'];
    
                
?>                                            
                                            <tr>
                                                <td>1</td>
                                                <td id="desc"><?php echo $desc; ?></td>
                                                <td id="cPaid"><?php echo $paid; ?></td>
                                                <td><?php echo $month; ?></td>
                                                <td><?php echo $date; ?></td>
                                            </tr>
<?php 

}else{
	
   echo "<tr><td colspan='5'>No data...!</td></tr>";
   
}
     
?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" col-md-5" style="">
                                	<div class="box">    
                                    	<h3>Add Payment</h3>
                                        <form role="form" action="../index.php" method="post" id="form1" class="form-horizontal" >
                                            <div class="box-body" >
                                                <div class="form-group" id="divIndexNumber">
                                                    <div class="col-xs-4">
                                                        <label>Type</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <select class="form-control"  id="type" name="type">			
                                                            <option value="selectType">Select Type</option>
                                                            <option value="Monthly Fee">Monthly Fee</option>
                                                        </select>
                                                    </div>                    
                                                </div>
                                                <div class="form-group" >
                                                    <div class="col-xs-4" >
                                                        <label>Amount</label>
                                                    </div>
                                                    <div class="col-xs-8" id="divAmount">
                                                        <input type="text" class="form-control" placeholder="Enter amount" name="amount" id="amount" autocomplete="off">  
                                                    </div>                    
                                                </div>
                                            </div>
                                            <div class="box-footer text-right ">
                                                <input type="hidden" name="index_number" value="<?php echo $index; ?>"  />
                                                <input type="hidden" name="invoice_number" value="<?php echo $inv_number; ?>"  />
                                                <input type="hidden" name="totalsfee" value="<?php echo $total; ?>"  />
                                                <input type="hidden" name="page" value="<?php echo $page; ?>"  />
                                                <input type="hidden" name="do" value="add_student_payment"  />
                                                <input type="hidden" name="showPage" value="all_student"  />
                                                <button type="submit" class="btn btn-primary btn-success" id="btnSubmit"><small><span class="glyphicon glyphicon-usd"></span></small>Paid</button>
                                            </div>
                                        </form>
                                	</div>        
                                </div>
                            </div>
                        </div><!--/.panel-body -->
                    </div><!--/. panel--> 
            	</div>        
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal --> 