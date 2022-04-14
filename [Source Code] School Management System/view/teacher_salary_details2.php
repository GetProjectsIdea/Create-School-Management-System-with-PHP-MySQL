<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewSalary1" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog1"><!--modal-dialog -->  
		<div class="container modal-content2"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-12">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-aqua-active">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<?php
include_once('../controller/config.php');
$id=$_GET['teacher_id'];
$sql="SELECT * FROM teacher WHERE id='$id'"; 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
?>                           
                            <h4 class="panel-title" id="tName"><?php echo $name; ?></h4>
                            
                        </div>
                        <div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class=" col-md-12 table1-responsive"> 
                                        <h3>Total Salary For This Month</h3>
                                    <table class="table table-bordered table-striped" id="tableSdetails2">
                                        <thead>
                                            <th class="col-md-1">#</th>
                                            <th class="col-md-1">Grade</th>
                                            <th class="col-md-1">Subject</th>
                                            <th class="col-md-1">Subject Fee($)</th>
                                            <th class="col-md-1">Student Count</th>
                                            <th class="col-md-1">Hall Charge(%)</th>
                                            <th class="col-md-1">Subtotal</th>
                                            <th class="col-md-1 ">Total</th>
                                        </thead>
                                        <tbody id="tBody">
<?php
include_once('../controller/config.php');
$id=$_GET['teacher_id'];
$page=$_GET['page'];
$current_month=date('F');

$count = 0;
$total = 0;
$s_count=0;
$student_count1=0;  
$subject_fee1=0;     

$sql="select grade.name as g_name,grade.hall_charge as h_charge,subject.name as s_name,subject_routing.fee as sr_fee,subject_routing.id as sr_id,subject_routing.grade_id as g_id,subject_routing.subject_id as s_id
      from subject_routing
      inner join grade
      on subject_routing.grade_id=grade.id
      inner join subject
      on subject_routing.subject_id=subject.id
      where subject_routing.teacher_id='$id'";
          
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
            
            $sr_id= $row['sr_id'];
            $grade_id=$row['g_id'];
			$subject_id=$row['s_id'];
			$hall_charge=$row['h_charge'];
			
			$sql2="SELECT 
	               DISTINCT index_number
                   FROM
  	                   student_subject
	               WHERE
  		               _status='leave' and year='2017'  
	               ORDER BY
  		               index_number";

          $result2=mysqli_query($conn,$sql2);

         if(mysqli_num_rows($result2) > 0){
	        while($row2=mysqli_fetch_assoc($result2)){	
		        $index_number=$row2['index_number'];
				
		        $sql3="SELECT *  FROM student_payment_history WHERE index_number='$index_number' and teacher_id='$id' and grade_id='$grade_id' and subject_id='$subject_id' and _status='Monthly_Fee' and month='$current_month'";
			
		        $result3=mysqli_query($conn,$sql3);
				if(mysqli_num_rows($result2) > 0){
					while($row3=mysqli_fetch_assoc($result3)){
						
					    $index1=$row3['index_number'];
					    $subject_fee1=$row3['subject_fee'];
					    $student_count1=mysqli_num_rows($result2);
					   
				   }
				 
				}
				
	        }
	
         }
		    
            $sql1="SELECT count(index_number)
                   FROM student_subject
                   WHERE sr_id='$sr_id' and	_status=''";
                   
            $result1=mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_assoc($result1);
            $s_count=$row1['count(index_number)'];
            $student_count=$s_count+$student_count1;
			
            $count++;
			
            $subtotal=$row['sr_fee']*$student_count;
			$subtotal1=$subtotal - ($subtotal*$hall_charge/100);
            $total+=$subtotal1;
            
            $subtotal1 = number_format($subtotal1, 2, '.', '');
            $total1 = number_format($total, 2, '.', '');
			
?> 
    
                                            <tr>
                                                <td>Class <?php echo $count; ?></td>
                                                <td><?php echo $row['g_name']; ?></td>
                                                <td><?php echo $row['s_name']; ?></td>
                                                <td><?php echo $row['sr_fee']; ?></td>
                                                <td><?php echo $student_count; ?></td>
                                                <td><?php echo $hall_charge; ?></td>
                                                <td>$<?php echo $subtotal1; ?></td>
                                                <td id="tSalary">$<?php echo $total1; ?></td>
                                            </tr>
<?php } } ?>                                        
                                        </tbody>
                                    </table>
                                    
                                </div>
                                
                                <div class=" col-md-7 table2-responsive">
                                    
                                        <h3>Last Payment</h3>
                                     
                                    <table class="table table-bordered table-striped" id="tableSdetails3">
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
         
$sql1="SELECT * FROM teacher_salary ORDER BY id DESC LIMIT 1";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$last_id1=$row1['id'];
$inv_number=$last_id1+1; 
    
$sql2="SELECT * FROM teacher_salary WHERE index_number='$index' ORDER BY id DESC LIMIT 1";
$result2=mysqli_query($conn,$sql2);
    
if(mysqli_num_rows($result2) > 0){
        
	$row2=mysqli_fetch_assoc($result2);
        
    $desc=$row2['_status'];
    $paid=$row2['paid'];
    $month=$row2['month'];
    $date=$row2['date'];
                
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
                                   <p class="alert-info al"><strong>Note1:</strong> You can get the Advance of Salary 5<sup>th</sup> to 25<sup>th</sup> Every Month.</p>
                                   <p class="alert-warning"><strong>Note2:</strong> Before 25<sup>th</sup>  you can’t get full payment.</p>  
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
                                                            <option value="Advance">Advance</option>
                                                            <option value="Total Salary">Total Salary</option>
                                                            <option value="Balance">Balance</option>
                                                        </select>
                                                    </div>                    
                                                </div>
                                                <div class="form-group" id="divFullName">
                                                    <div class="col-xs-4">
                                                        <label>Amount</label>
                                                    </div>
                                                    <div class="col-xs-8" id="divAmount">
                                                        <input type="text" class="form-control" placeholder="Enter amount" name="amount" id="amount" autocomplete="off">  
                                                    </div>                    
                                                </div>
                                            </div>
                                            <div class="box-footer text-right">
                                                <input type="hidden" name="index_number" value="<?php echo $index; ?>"  />
                                                <input type="hidden" name="teacher_id" value="<?php echo $id; ?>"  />
                                                <input type="hidden" name="invoice_number" value="<?php echo $inv_number; ?>"  />
                                                <input type="hidden" name="page" value="<?php echo $page; ?>"  />
                                                <input type="hidden" name="do" value="add_teacher_salary"  />
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