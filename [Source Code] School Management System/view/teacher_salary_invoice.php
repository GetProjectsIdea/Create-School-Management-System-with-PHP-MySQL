<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
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
$id=$_GET['teacher_id'];
$inv_number=$_GET['invoice_number'];
$desc=$_GET['desc'];
$total_salary=$_GET['total_salary'];
$paid=$_GET['paid'];
$balance=0;
$advance1=0;


$total_salary = number_format($total_salary, 2, '.', '');
$paid = number_format($paid, 2, '.', '');

$current_month=date('F');
$current_date=date('Y-m-d');

$sql="select * from teacher where id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$index=$row['index_number'];

$sql2="select * from teacher_salary where index_number='$index' and _status='Advance' and month='$current_month'";
$result2=mysqli_query($conn,$sql2);
if(mysqli_num_rows($result2) > 0){	
	$row2=mysqli_fetch_assoc($result2);
	$desc1=$row2['_status'];
	$advance1=$row2['paid'];
	$month1=$row2['month'];
	$year1=$row2['year'];
	$date1=$row2['date'];
}

$balance=$total_salary-$advance1;
$balance=number_format($balance, 2, '.', '');
?>                                    
                                  <span class="std-name"><?php echo $row['i_name']; ?></span><br>
                                    	455 Foggy Heights,<br>
									    AZ 85004, US
                                    </div>
                                </div>
                                <div class="col-xs-5 col-xs-offset-2 text-right msk-t">
                                	<br>
                                    
                                	<h3>INVOICE - #<?php echo $inv_number; ?></h3>
                                    <div class="text-right">
                                    	Year: 2017<br>
                                        Month: July<br>
                                    	Date: 12/06/2017
									    
                                    </div>                                
                                </div>
      						</div> <!-- / end client details section -->
                            
                             <table class="table table-bordered">
                                <thead>
                                    <th class="col-md-1">ID</th>
                                    <th class="col-md-1">Description</th>
                                    <th class="col-md-1">Amount($)</th>
                                    <th class="col-md-1">Month</th>
                                    <th class="col-md-1">Date</th>
                                </thead>
								<tbody>
                                	<tr id="trBalance">
                                    	<td id="countAdvance">1</td>
                                       	<td><?php echo $desc1; ?></td>
                                        <td>$<?php echo $advance1; ?></td>
                                        <td><?php echo $month1; ?></td>
                                        <td><?php echo $date1; ?></td>
                                    </tr>
                                    <tr>
                                    	<td id="countBalance"> 1</td>
                                       	<td><?php echo $desc; ?></td>
                                        <td>$<?php echo $paid; ?></td>
                                        <td><?php echo $current_month; ?></td>
                                        <td><?php echo $current_date; ?></td>
                                    </tr>
                 				</tbody>
                          	</table> 
                            
                            <div class="row">
								<div class="col-xs-1 pdetail1">							
                       				<strong>
                                    	<span id="spanTotal">$<?php echo $total_salary; ?></span> <br>
                                        <span id="spanAdvance">$<?php echo $advance1; ?></span> <br>
			 							<span id="spanBalance">$<?php echo $balance; ?></span> <br>
                                       	<span id="spanPaid">$<?php echo $paid; ?></span> <br>
                                    </strong>
  								</div>
                     			<div class="col-xs-3 text-right pdetail2">
    								<p>
                                    	<strong>
                                        	Total Salary :<br>
                                        	Advance :<br>
											Balance :<br>
                                        	Paid :<br>
                                      	</strong>
                                    </p>
  								</div>
							</div>
                            <div class="col-xs-6 col-xs-offset-2 text-right">
                            	<h1 id="h1">Thank You!</h1>
                            </div>
                  		</div><!--/.panel-body -->
                	</div><!--/. panel--> 
                </div><!--/.row --> 
            </div><!--/.modal-content -->
        </div><!--/.modal-dialog -->
    </div><!--/.modal -->