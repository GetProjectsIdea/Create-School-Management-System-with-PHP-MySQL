<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewPayment1" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-6">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-aqua-active">
                            <button type="button" class="close" onClick="scrollDown()" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
                                <div class=" col-md-12"> 
<?php

$month=$_GET['month'];
?>                                
                                        <h3>Monthly Fee for <?php echo $month; ?></h3>
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
$year=$_GET['year'];
$month=$_GET['month'];

$count = 0;
$total = 0;

$sql="select grade.name as g_name,subject.name as s_name,student_payment_history.subject_fee as s_fee 
      from student_payment_history
	  inner join grade
	  on student_payment_history.grade_id=grade.id
	  inner join subject
	  on student_payment_history.subject_id=subject.id
      where student_payment_history.index_number='$index' and student_payment_history.year='$year' and student_payment_history.month='$month' and student_payment_history._status='Monthly Fee'";
	  
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
            
			$total+=$row['s_fee'];
			$total = number_format($total, 2, '.', '');
			$count++;
			
?> 
    
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['g_name']; ?></td>
                                                <td><?php echo $row['s_name']; ?></td>
                                                <td><?php echo $row['s_fee']; ?></td>
                                                <td id="tSalary"><?php echo $total; ?></td>
                                            </tr>
<?php } } ?>                                        
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