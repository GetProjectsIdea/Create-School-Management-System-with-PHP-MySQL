<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php
include_once('../controller/config.php');
$msg_id=$_GET['msg_id'];
$grade=0;
$prefix="";
$grade_name="";
$group="";

$sql="SELECT * FROM group_message WHERE id='$msg_id'";
	 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
	$grade=$row['grade'];
	$group=$row['group_id'];
	$message=$row['message'];
	
	if($group == 1){
		$group = "All";
	}else if($group == 2){
		$group = "All Teachers & Student";
	}else if($group == 3){
		$group = "All Teachers & Specific Grades";
	}else if($group == 4){
		$group = "Only Specific Grades";
	}else if($group == 5){
		$group = "Only Teachers";
	}else if($group == 6){
		$group = "Only Students";
	}else if($group == 7){
		$group = "Only Parents";
	}else{
		
	}
	/*
	$creator_type=$row['creator_type'];
	$create_by=$row['create_by'];
	
	if($creator_type == "Admin"){
		
		$sql1="SELECT * FROM admin WHERE index_number='$create_by'";
	 
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$name=$row1['i_name'];
		
	}
	
	*/
	
?>

<div class="modal msk-fade" id="modalviewGMessage" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog"><!--modal-dialog -->  
		<div class="container col-lg-6 modal-content1"><!--modal-content --> 
      		<div class="row">
          		<div class="panel"><!--panel --> 
            		<div class="panel-heading bg-orange">
                    	<button type="button"  class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              			<h3 class="panel-title"><?php echo $group; ?></h3>
            		</div>
            		<div class="panel-body"><!--panel-body -->
              			<div class="row">
                			<div class=" col-md-12"> 
                  				<table class="table table-user-information">
                    				<tbody>
                      					<tr>
                        					<td>Group:</td>
                        					<td id="category1"><?php echo $group; ?></td>
                      					</tr>
                             			<tr>
                        					<td>Grade</td>
                        					<td id="grade1">
                                            	<?php 
													if($grade){
														
														$g=(explode(",",$grade));
														
														for($i=0;$i<count($g);$i++){
															$id=$g[$i];
															
															
															$sql1="SELECT * FROM grade WHERE id =$id";
															$result1=mysqli_query($conn,$sql1);
															$row1=mysqli_fetch_assoc($result1);
															
															$grade_name.=$prefix.$row1['name'];
															$prefix=',';
															
														}
														echo $grade_name;
													}else{
														echo "All";
													}
												?>
                                             </td>
                      					</tr>
                        				<tr>
                        					<td>Message</td>
                        					<td > 
												<textarea class="form-control" rows="5" disabled><?php echo $message; ?></textarea>
                                            </td>
                      					</tr>
                    				</tbody>
                  				</table>
                  			</div>
                   		</div>
                  	</div><!--/.panel-body -->
            	</div><!--/. panel--> 
			</div><!--/.row --> 
    	</div><!--/.modal-content -->
	</div><!--/.modal-dialog -->
</div><!--/.modal -->  