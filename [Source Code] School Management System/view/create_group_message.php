 <?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
 <div class="modal msk-fade" id="modalcNewMessage" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<!-- Modal content-->
    	<div class="container msk-modal-content"><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-6">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add New Group Message</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="formExam" class="form-horizontal">
            				<div class="panel-body"> <!-- Start of modal body--> 
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Group:</label>
                                    </div>
                                    <div class="input-group col-md-4" id="divYear1">
                                        <select name="group" class="form-control" id="group" style="width:105%;"><!--MSK-000107-->
                                            <option value="0">Select Category</option>
                                            <option value="1">All</option>
                                    		<option value="2">All Teachers & Student</option>
                                            <option value="3">All Teachers & Specific Grades</option>
                                            <option value="4">Only Specific Grades</option>
                                            <option value="5">Only Teachers</option>
                                            <option value="6">Only Students</option>
                                            <option value="7">Only Parents</option>
                                		</select> 
                            		</div> 
                                </div>
                                
                                <div class="form-group " id="divGrade">
                               		<div class="col-md-3">
                                    	<label>Grade:</label>
                                    </div>
                                    <div class="input-group col-md-4" id="divYear1">
                                   		<table class="table borderless">
                                        	<tbody>   
<?php
include_once('../controller/config.php');
$my_type=$_GET['my_type'];
$my_index=$_GET['my_index'];

$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                                <tr>
                                                    <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $row["id"]; ?>"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
<?php }} ?>
                                			</tbody>
                                     	</table>       
                            		</div> 
                            	</div> 
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Message:</label>
                                    </div>
                                    <div class="input-group col-md-8" id="divYear1">
                                        <textarea class="form-control" id="gmessage" name="gmessage" rows="5"></textarea>
                            		</div> 
                            	</div> 
            				</div><!--/.modal body-->
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden" name="my_type" value="<?php echo $my_type; ?>"/>
                            	<input type="hidden" name="my_index" value="<?php echo $my_index; ?>"/>
            					<input type="hidden" name="do" value="add_group_message"/>
                    			<button type="submit" class="btn btn-info btnS" id="btnSubmit3" style="width:100%;">Submit</button>
             				</div>
             			</form>      
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->