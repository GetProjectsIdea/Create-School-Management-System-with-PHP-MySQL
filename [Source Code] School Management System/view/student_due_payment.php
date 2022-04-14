<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalviewDuePayment" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container"><!--modal-content --> 
      		<div class="row">
            	<div class="col-md-6">
                    <div class="panel"><!--panel --> 
                        <div class="panel-heading bg-aqua-active">
                            <button type="button" class="close" onClick="showAllNotfi1()" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<?php
include_once('../controller/config.php');
$index=$_GET['std_index'];
$month=$_GET['due_month'];
$sql="SELECT * FROM student WHERE index_number='$index'"; 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];

$sql1="select grade.name as g_name
       from student_grade
	   inner join grade
	   on student_grade.grade_id=grade.id
	   where student_grade.index_number='$index'"; 
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$grade=$row1['g_name'];

?>                           
                            <h4 class="panel-title" id="tName"><?php echo $name; ?></h4>
                        </div>
                        <div class="panel-body"><!--panel-body -->
                            <div class="row">
                                <div class=" col-md-12"> 
                                <h5>Name: <?php echo $name; ?> </h5>
                                <h5>Grade: <?php echo $grade; ?> </h5>
                                <h5>Month: <?php echo $month; ?> </h5>
                                
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
$index=$_GET['std_index'];
$year=$_GET['due_year'];
$month=$_GET['due_month'];

$count = 0;
$total = 0;

$sql="SELECT * FROM student_subject WHERE index_number='$index' AND year='$year'";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
	
	$sr_id=$row['sr_id'];
	$count++;
	
	$sql1="select grade.name as g_name,subject.name as s_name,subject_routing.fee as s_fee
		   from subject_routing
		   inner join grade
		   on subject_routing.grade_id=grade.id
		   inner join subject
		   on subject_routing.subject_id=subject.id
		   where subject_routing.id='$sr_id'";
	
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	
	$g_name=$row1['g_name'];
	$s_name=$row1['s_name'];
	$s_fee=$row1['s_fee'];
	$total+=$s_fee;
	
?> 
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $g_name; ?></td>
                                                <td><?php echo $s_name; ?></td>
                                                <td><?php echo $s_fee; ?></td>
                                                <td id="tSalary"><?php echo $total; ?></td>
                                            </tr>
<?php }  ?>                                        
                                        </tbody>
                                    </table>
                                    <div class="text-right">
                                    	<strong>Due Amount: <span style="color:red;">$<?php echo $total; ?></span> </strong>
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