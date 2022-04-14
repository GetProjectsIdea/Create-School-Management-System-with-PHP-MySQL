<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php
include_once("../controller/config.php");
for($i=0;$i<count(json_decode($_GET['id']));$i++){

	$index=$_GET['index'];
	$id = json_decode($_GET['id'], true);
	$year=date('Y');
	
	$sql = "INSERT INTO student_subject(index_number,sr_id,year)
			VALUES ('".$index."','".$id[$i]."','".$year."')";
	mysqli_query($conn,$sql);
		
}

?>

<?php
include_once("../controller/config.php");

	$index=$_GET['index'];
	$grade_id=$_GET['grade'];
	$year=date('Y');
	
	$sql = "INSERT INTO student_grade(index_number,grade_id,year)
			VALUES ('".$index."','".$grade_id."','".$year."')";
	mysqli_query($conn,$sql);
		
?>

	<!--MSK-000136-->
	<div class="modal msk-fade" id="modalINV" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog"><!--modal-dialog -->  
			<div class="container col-lg-12 "><!--modal-content --> 
      			<div class="row">
          			<div class="panel panel-info"><!--panel -->
                    	<div class="msk-heading">
                       
                    	<button type="button" onClick="" class="close  " data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>	
                        <br>
                        </div>
            			<div class="panel-body"><!--panel-body -->
                        	<div class="row " id="msk12345">
                            	<div class="col-xs-2">
                                	<div class="div-logo">
                                    	<img class="logo" src="../uploads/logo2.png">
                                    </div>
                                </div>
                                <div class="col-xs-5 class-name">
                                	<h2>ILovePrograming</h2>
                                	<div class="class-address">
                                    	455 Foggy Heights,<br>
									    AZ 85004, US
                                    </div>
                                </div>
                                <div class="col-xs-4 class-email text-right ">
                                    	Email: msk.ms4@gmail.com<br>
                                        Phone: 111-111-1111 <br> 
                                </div>
                        	</div>
                            <div class="row ">
                                <div class="col-xs-5">
                                   <h4>INVOICE TO:</h4>
                                    <div class="student-address">
<?php
include_once("../controller/config.php");
$index=$_GET['index'];
$sql="select * from student where index_number='$index'";
$result=mysqli_query($conn,$sql);	
while($row=mysqli_fetch_assoc($result)){

?>                                    
                                  <span class="std-name"><?php echo $row['i_name']; ?></span><br>
                                    	455 Foggy Heights,<br>
									    AZ 85004, US
<?php } ?>                                        
                                    </div>
                                </div>
                                <div class="col-xs-5 col-xs-offset-2 text-right msk-t">
                                	<br>
<?php                                	
$sql2="SELECT * FROM student_payment ORDER BY id DESC LIMIT 1";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$id2=$row2['id'];
$inv_number=$id2+1; 
?>                                    
                                	<h3>INVOICE - #<?php echo $inv_number; ?></h3>
                                    <div class="text-right">
                                    	Year: 2017<br>
                                    	Month: June<br>
                                    	Date: 12/06/2017
                                    </div>                                
                                </div>
      						</div> <!-- / end client details section -->
                            
                             <table class="table table-bordered">
                                <thead>
								  <tr class="row1">
                                    <th class="th">#</th>
                                    <th>Description</th>
                                    <th class="text-right">Fee</th>
                                    <th class="text-right">Sub Total</th>
                                  </tr>
                                </thead>
                                <tbody>
<?php
include_once("../controller/config.php");

$index=$_GET['index'];
$grade_id=$_GET['grade'];	
$sql1="select * from grade where id='$grade_id'";
$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
$a_fee=$row1['admission_fee'];
?>                                
                                  <tr>
                                    <td>1</td>
                                    <td>Admission Fee</td>
                                    <td class="text-right" id="jw123"><?php echo $row1['admission_fee']; ?></td>
                                    <td class="text-right"><?php echo $row1['admission_fee']; ?></td>
                                  </tr>
<?php }  ?>                                    
<?php
include_once("../controller/config.php");
$monthly_fee=0;
for($i=0;$i<count(json_decode($_GET['id']));$i++){

	$index=$_GET['index'];
	$id = json_decode($_GET['id'], true);
	
	$sql1="select subject.name as s_name, subject_routing.fee as s_fee
		   from subject_routing
	       inner join subject
		   on subject_routing.subject_id=subject.id
		   where subject_routing.id='$id[$i]'";
	
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);

$monthly_fee+=$row1['s_fee'];
$monthly_fee = number_format($monthly_fee, 2, '.', '');
$total=$a_fee+$monthly_fee; 
$total = number_format($total, 2, '.', '');
?>
                                  	<tr>
                                        <td><?php echo $i+2; ?></td>
                                        <td class="">Monthly Fee - <?php echo $row1['s_name']; ?></td>
                                        <td class="text-right"><?php echo $row1['s_fee']; ?></td>
                                        <td class="text-right"><?php echo $row1['s_fee']; ?></td>
                                	</tr>
<?php } ?>                  	</tbody>
                          	</table> 
                            <div class="row">
                                <div class="col-xs-1 text-right pdetail1">
                                      <strong>
                                        <span id=""><?php echo $a_fee; ?>$</span> <br>
                                        <span id=""><?php echo $monthly_fee; ?>$</span> <br>
										<span id=""><?php echo $total; ?>$</span> <br>
                                        <span id=""><?php echo $total; ?>$</span> <br>
                                      </strong>
  								</div>
                                <div class="col-xs-3 text-right pdetail2">
    								<p>
                                      <strong>
                                        Admission Fee :
                                        Monthly Fee :<br>
										Total :<br>
                                        Paid :<br>
                                      </strong>
                                    </p>
  								</div>
							</div>
                            <div class="col-xs-6 col-xs-offset-2 text-right">
                            	<h1 id="h1">Thank You!</h1>
                            </div>
                  		</div><!--/.panel-body -->
						<div class="panel-footer inv-footer text-right" id="msk123456">
            					 <input type="hidden" id="inv_num" name value="<?php echo $inv_number; ?>"  />
                                <input type="hidden" id="index" value="<?php echo $index; ?>"  />
                                <input type="hidden" id="a_fee" value="<?php echo $a_fee; ?>"  />
                                <input type="hidden" id="total_sfee" value="<?php echo $monthly_fee; ?>"  />
                    			<button type="button" class="btn btn-primary btn-md"  id="btnSubmit1" onClick="addSPayment(this)">
                                	<small><span class="glyphicon glyphicon-usd"></span></small>Paid<!--MSK-000138-->
                                </button>
             			</div>                    
                	</div><!--/. panel--> 
                </div><!--/.row --> 
            </div><!--/.modal-content -->
        </div><!--/.modal-dialog -->
    </div><!--/.modal -->