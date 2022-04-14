<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewSalary2" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container modal-content3"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-10">
                    <div class="panel"><!--panel bg-maroon--> 
                        <div class="panel-heading bg-aqua-active">
                    		<button type="button" class="close" onClick="scrollDown()" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

<?php
include_once('../controller/config.php');
$index=$_GET['index'];

$sql="SELECT * FROM teacher WHERE index_number='$index'"; 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];

?>                            
              				<h3 class="panel-title" id="tName"><?php echo $name; ?></h3>
            			</div>
                        <div class="panel-body "><!--panel-body -->
                            <div class="row">
                                <div class="col-md-12"> 
                                
<?php $month=$_GET['month']; ?>  

                                    <h4>Total Salary For <?php echo $month; ?></h4>
                                    <table class="table table-bordered table-striped" id="tableSdetails3">
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
$index=$_GET['index'];
$year=$_GET['year'];
$month=$_GET['month'];

$sql="select grade.name as g_name,grade.hall_charge as h_charge,subject.name as s_name,teacher_salary_history.subject_fee as s_fee,teacher_salary_history.subtotal as s_sub,teacher_salary_history.student_count as s_count
      from teacher_salary_history 
	  inner join grade
	  on teacher_salary_history.grade_id=grade.id
	  inner join subject
	  on teacher_salary_history.subject_id=subject.id
      where teacher_salary_history.index_number='$index' and teacher_salary_history.year='$year' and teacher_salary_history.month='$month' and (_status='Advance' or _status='Total Salary')";
        
$result=mysqli_query($conn,$sql);
$count = 0;
$total = 0;
    
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		
    	$total+= $row['s_sub'];      
    	$count++;	
?> 
                                            <tr>
                                                <td>Class <?php echo $count; ?></td>
                                                <td><?php echo $row['g_name']; ?></td>
                                                <td><?php echo $row['s_name']; ?></td>
                                                <td><?php echo $row['s_fee']; ?></td>
                                                <td><?php echo $row['s_count']; ?></td>
                                                 <td><?php echo $row['h_charge']; ?></td>
                                                <td>$<?php echo $row['s_sub']; ?></td>
                                                <td id="tSalary">$<?php echo $total; ?></td>
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