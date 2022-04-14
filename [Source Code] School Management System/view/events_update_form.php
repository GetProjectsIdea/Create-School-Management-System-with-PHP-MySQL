<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
 <div class="modal msk-fade" id="modaluEvent" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<!-- Modal content-->
    	<div class="container msk-modal-content"><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-6">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Edit Event</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="formExam" class="form-horizontal">
            				<div class="panel-body"> <!-- Start of modal body--> 
                               
                                <div class="form-group " id="">
                                	<div class="col-md-3">
                                    	<label for="" >Title:</label>
                                    </div>
                                    
                                    <div class="input-group col-md-8">
                                    	<input type="text" class="form-control" name="title" id="title1" value="<?php echo $row['title']; ?>" autocomplete="off">
                                    </div>      						
                                </div>
        					
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Category:</label>
                                    </div>
                                    <div class="input-group col-md-4" id="divYear1">
                                        <select name="category" class="form-control" id="category1" style="width:105%;"><!--MSK-000107-->
                                            <option>Select Category</option>
                                    
<?php
include_once('../controller/config.php');
    
$sql="SELECT * FROM event_category";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                    		<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
                                		</select> 
                            		</div> 
                                </div>
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Type:</label>
                                    </div>
                                    
                                 
                                    <div class="input-group col-md-4" id="divYear1">
                                        <select name="category_type" class="form-control" id="type1" style="width:105%;"><!--MSK-000107-->
                                            <option value="0">Select Type</option>
                                    
<?php
include_once('../controller/config.php');
    
$sql="SELECT * FROM event_category_type";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                    		<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
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
$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                                                <tr>
                                                    <td><input type="checkbox" name="checkbox[]" id="checkbox1" value="<?php echo $row["id"]; ?>"></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
<?php }} ?>
                                			</tbody>
                                     	</table>       
                            		</div> 
                            	</div> 
                                 <div class="form-group " id="divExam">
                                	<div class="col-md-3">
                                    	<label>Date and time range:</label>
                                    </div>
                                    <div class="input-group col-md-8">
                                    	<div class="input-group-addon">
                                        	<i class="fa fa-clock-o"></i>
                                         </div>
                                    	<input type="text" class="form-control pull-right" id="reservationtime1" name="date_time_range">
                                    </div><!-- /.input group -->
                              	</div> 
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Note:</label>
                                    </div>
                                    <div class="input-group col-md-8" id="divYear1">
                                        <textarea class="form-control" id="note" name="note1" rows="3"></textarea>
                            		</div> 
                            	</div> 
      
                                <div class="form-group " id="divExamSubject">
                               		<div class="col-md-3">
                                    	<label>Color:</label>
                                    </div>
                                    
                                 
                                    <div class="input-group col-md-4 my-colorpicker2">
                                      <input type="text" class="form-control" name="color">
                                      <div class="input-group-addon">
                                        <i></i>
                                      </div>
                                    </div><!-- /.input group -->
                            		<br><br><br>
                            	</div> 
            				</div><!--/.modal body-->
            
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden" name="my_type" value=""/>
                            	<input type="hidden" name="my_index" value=""/>
            					<input type="hidden" name="do" value="update_events"/>
                    			<button type="submit" class="btn btn-info btnS" id="btnSubmit3" style="width:100%;">Update</button>
             				</div>
             			</form>      
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->


