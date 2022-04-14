<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
 <div class="modal msk-fade" id="inserteMark" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<!-- Modal content-->
    	<div class="container msk-modal-content"><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-3">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add Exam Marks</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="formExam">
            				<div class="panel-body"> <!-- Start of modal body--> 
                                <div class="form-group " id="divExam">
                                	
                						<label for="" >Exam</label>
                                	
        								<select class="form-control"  id="exam" name="exam_id">			
     										<option>Select Exam</option>
<?php
//MSK-00098
include_once('../controller/config.php');
$index_number=$_GET['index'];
$current_page=$_GET['currentPage'];
$sql="SELECT * FROM exam";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     										<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>	          
										</select>
                                	</div>
        					
                                <div class="form-group " id="divExamSubject">
                                    
                                   
                            	</div> 
                                   
            				</div><!--/.modal body-->
            
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden" name="current_page" value="<?php echo $current_page; ?>"/>
                            	<input type="hidden" name="index" value="<?php echo $index_number; ?>"/>
            					<input type="hidden" name="do" value="add_student_exam_mark"/>
                    			<button type="submit" class="btn btn-info btnS" id="btnSubmit3" style="width:100%;">Submit</button>
             				</div>
             			</form>      
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->