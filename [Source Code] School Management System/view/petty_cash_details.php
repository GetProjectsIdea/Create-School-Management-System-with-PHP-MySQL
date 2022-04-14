<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal msk-fade" id="modalViewPettyCash" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog"><!--modal-dialog -->  
			<div class="container col-lg-12 "><!--modal-content --> 
      			<div class="row">
          			<div class="panel panel-info"><!--panel -->
                    	<div class="msk-heading">
                    		<button type="button" onClick="scrollDown()" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>	
                        <br>
                        </div>
            			<div class="panel-body"><!--panel-body -->
                        	<div class="row ">
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
                                <center><h1>Petty Cash</h1></center>
                                <div class="col-xs-5 col-xs-offset-7 text-right msk-t">
<?php  
include_once('../controller/config.php');       

$id=$_GET['id'];                       
$sql1="SELECT * FROM petty_cash WHERE id='$id'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$year=$row1['year'];
$month=$row1['month'];
$date=$row1['date'];
$received_type=$row1['received_type'];
$received_by=$row1['received_by'];
$approved_by=$row1['approved_by'];
if($received_type=="Teacher"){
			
	$sql1="SELECT * FROM teacher WHERE index_number='$received_by'";
			
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$received_by=$row1['i_name'];
}
		
if($received_type=="Admin"){
			
	$sql1="SELECT * FROM admin WHERE index_number='$received_by'";
			
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$received_by=$row1['i_name'];
}

?>   
                                    <div class="text-right">
                                    	Year: <?php echo $year; ?><br>
                                        Month: <?php echo $month; ?><br>
                                    	Date: <?php echo $date; ?>
                                    </div>                                
                                </div>
      						</div> <!-- / end client details section -->
                             <table class="table table-bordered">
                                <thead>
                                    <th class="col-md-1">ID</th>
                                    <th class="col-md-2">Description</th>
                                    <th class="col-md-1">Amount($)</th>
                                </thead>
								<tbody>
<?php  
include_once('../controller/config.php');       

$invoice_number=$_GET['id'];                       
$sql2="SELECT * FROM petty_cash_history WHERE invoice_number='$invoice_number'";
$result2=mysqli_query($conn,$sql2);
$count=0;
$total=0;
while($row2=mysqli_fetch_assoc($result2)){
$_desc=$row2['_desc'];
$amount=$row2['amount'];
$total+=$amount;
$total = number_format($total, 2, '.', '');
$count++;
?>                                
                                    <tr>
                                    	<td><?php echo $count; ?></td>
                                       	<td><?php echo $_desc; ?></td>
                                        <td><?php echo $amount; ?></td>
                                    </tr>
<?php } ?>                                    
                                    <tr>
                                    	<td colspan="2"><strong>Total</strong></td>
                                       	<td><?php echo $total; ?></td>
                                    </tr>
                 				</tbody>
                          	</table> 
                          	<div class="row ">
                            	<div class="col-xs-6">
                                	<strong>Received By :-</strong> <?php echo $received_by; ?>
                                </div>
                                <div class="col-xs-6 text-right">
<?php                                
include_once('../controller/config.php');
$sql1="SELECT * FROM admin";
			
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);

$name=$row1['i_name'];

?>                                
                                	<strong>Approved By :-</strong> <?php if($approved_by != 0){ echo $name;} ?>
                                	
                                </div>
                        	</div>  
                  		</div><!--/.panel-body -->
                        <div class="panel-footer inv-footer text-right" id="msk123456">
                        	<button type="button" class="btn btn-success btn-md"  id="" onClick="window.print()">
                            	<span class="glyphicon glyphicon-print"></span> Print<!--MSK-000137--> 
                            </button>
             			</div>
                	</div><!--/. panel--> 
                </div><!--/.row --> 
            </div><!--/.modal-content -->
        </div><!--/.modal-dialog -->
    </div><!--/.modal -->
