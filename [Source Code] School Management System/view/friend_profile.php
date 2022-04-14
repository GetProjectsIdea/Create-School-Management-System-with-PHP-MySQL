<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}


include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Teacher")){
	
$index=$_GET['friend_index'];
$sql="SELECT * FROM teacher WHERE index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$i_name=$row['i_name'];
$full_name=$row['full_name'];
$image=$row['image_name'];
$address=$row['address'];
$gender=$row['gender'];
$phone=$row['phone'];
$email=$row['email'];

?>

<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-12 "><!--modal-content --> 
      		<div class="row">
        	<div class="col-md-12">
            	<div class="panel"><!--panel bg-maroon--> 
                	<div class="panel-heading bg-aqua-active">	
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    	<h4 class="panel-title" id="hname"><?php echo $i_name; ?></h4>
                    </div>				
                    <div class="panel-body"><!--panel-body -->
                    	<div class="row">
                			<div class="col-md-3"> 
                				<img id="photo2" alt="User Pic" src="../<?php echo $image; ?>" class="img-circle img-responsive"> 
                			</div>
                			<div class=" col-md-9"> 
                  				<table class="table table-bordered table-striped">
                    				<tbody>
                      					<tr>
                        					<td class="col-md-4">Full Name</td>
                        					<td id="full_name"><?php echo $full_name; ?></td>
                      					</tr>
                      					<tr>
                        					<td>Name With Initials</td>
                        					<td id="i_name"><?php echo $i_name; ?> </td>
                      					</tr>
                             			<tr>
                        					<td>Address</td>
                        					<td id="address"><?php echo $address; ?> </td>
                      					</tr>
                        				<tr>
                        					<td>Gender</td>
                        					<td id="gender"><?php echo $gender; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Email</td>
                        					<td id="email"><?php echo $email; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Phone Number</td>
                        					<td id="phone"><?php echo $phone; ?> </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                     </div>
            	</div><!--/. panel--> 
        	</div>
		</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  
<?php } ?>


<?php
include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Admin")){
	
$index=$_GET['friend_index'];
$sql="SELECT * FROM admin WHERE index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$i_name=$row['i_name'];
$full_name=$row['full_name'];
$image=$row['image_name'];
$address=$row['address'];
$gender=$row['gender'];
$phone=$row['phone'];
$email=$row['email'];

?>

<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-12 "><!--modal-content --> 
      		<div class="row">
        	<div class="col-md-12">
            	<div class="panel"><!--panel bg-maroon--> 
                	<div class="panel-heading bg-aqua-active">	
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    	<h4 class="panel-title" id="hname"><?php echo $i_name; ?></h4>
                    </div>				
                    <div class="panel-body"><!--panel-body -->
                    	<div class="row">
                			<div class="col-md-3"> 
                				<img id="photo2" alt="User Pic" src="../<?php echo $image; ?>" class="img-circle img-responsive"> 
                			</div>
                			<div class=" col-md-9"> 
                  				<table class="table table-bordered table-striped">
                    				<tbody>
                      					<tr>
                        					<td class="col-md-4">Full Name</td>
                        					<td id="full_name"><?php echo $full_name; ?></td>
                      					</tr>
                      					<tr>
                        					<td>Name With Initials</td>
                        					<td id="i_name"><?php echo $i_name; ?> </td>
                      					</tr>
                             			<tr>
                        					<td>Address</td>
                        					<td id="address"><?php echo $address; ?> </td>
                      					</tr>
                        				<tr>
                        					<td>Gender</td>
                        					<td id="gender"><?php echo $gender; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Email</td>
                        					<td id="email"><?php echo $email; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Phone Number</td>
                        					<td id="phone"><?php echo $phone; ?> </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                     </div>
            	</div><!--/. panel--> 
        	</div>
		</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  
<?php } ?>

<?php
include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Student")){
	
$index=$_GET['friend_index'];
$sql="SELECT * FROM student WHERE index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$i_name=$row['i_name'];
$full_name=$row['full_name'];
$image=$row['image_name'];
$address=$row['address'];
$gender=$row['gender'];
$phone=$row['phone'];
$email=$row['email'];


$sql1="SELECT * FROM parents WHERE my_son_index='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);

$g_name=$row1['i_name'];
$g_address=$row1['address'];
$g_email=$row1['email'];
$g_phone=$row1['phone'];


?>

<div class="modal msk-fade" id="modalviewFriend" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-12 "><!--modal-content --> 
      		<div class="row">
        	<div class="col-md-12">
            	<div class="panel"><!--panel bg-maroon--> 
                	<div class="panel-heading bg-aqua-active">	
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    	<h4 class="panel-title" id="hname"><?php echo $i_name; ?></h4>
                    </div>				
                    <div class="panel-body"><!--panel-body -->
                    	<div class="row">
                			<div class="col-md-3"> 
                				<img id="photo2" alt="User Pic" src="../<?php echo $image; ?>" class="img-circle img-responsive"> 
                			</div>
                			<div class=" col-md-9"> 
                  				<table class="table table-bordered table-striped">
                    				<tbody>
                      					<tr>
                        					<td class="col-md-4">Full Name</td>
                        					<td id="full_name"><?php echo $full_name; ?></td>
                      					</tr>
                      					<tr>
                        					<td>Name With Initials</td>
                        					<td id="i_name"><?php echo $i_name; ?> </td>
                      					</tr>
                             			<tr>
                        					<td>Address</td>
                        					<td id="address"><?php echo $address; ?> </td>
                      					</tr>
                        				<tr>
                        					<td>Gender</td>
                        					<td id="gender"><?php echo $gender; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Email</td>
                        					<td id="email"><?php echo $email; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Phone Number</td>
                        					<td id="phone"><?php echo $phone; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Guardians Name</td>
                        					<td id="g_name"><?php echo $g_name; ?> </td>
                      					</tr>
                        				<tr>
                        					<td>Guardians Address</td>
                        					<td id="g_address"><?php echo $g_address; ?> </td>
                      					</tr>
                      					<tr>
                        					<td>Guardians Email</td>
                        					<td id="g_email"><?php echo $g_email; ?> </td>
                      					</tr>
                                        <tr>
                        					<td>Guardians Phone</td>
                        					<td id="g_phone"><?php echo $g_phone; ?> </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                     </div>
            	</div><!--/. panel--> 
        	</div>
		</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  
<?php } ?>