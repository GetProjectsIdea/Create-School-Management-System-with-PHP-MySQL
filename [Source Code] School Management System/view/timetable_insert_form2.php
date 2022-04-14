<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<!-- //MSK-000119-1  modalInsertform -->  
<div class="modal msk-fade" id="modalInsertform" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<div class="container modal-content1 "><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-3 ">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add Subject Routing </h3>
   						</div>
            			 <form role="form" action="../index.php" method="post">
            				<div class="panel-body"> <!-- Start of modal body--> 
               					<div class="form-group" id="divDay">
                					<label for="" >Day</label>
        							<select class="form-control"  id="day" name="day">			
     									<option >Select Day</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
									</select>
        						</div>
                                 <div class="form-group" id="divGrade">
                					<label for="" >Grade</label>
        							<select class="form-control"  id="grade" name="grade_id"><!--MSK-000116-subject-->		
     									<option>Select Grade</option>
<?php
include_once('../controller/config.php');
$index=$_GET['index'];

$sql1="SELECT * FROM teacher WHERE index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id']; 

$sql="select DISTINCT subject_routing.grade_id as g_id,grade.name as g_name
      from subject_routing
      inner join grade
      on subject_routing.grade_id=grade.id 
      where subject_routing.teacher_id=$id";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     									<option value="<?php echo $row["g_id"]; ?>"><?php echo $row['g_name']; ?></option>
<?php }} ?> 	           
									</select>
        						</div>
                                <div class="form-group" id="divSubject">
                					<label for="" >Subject</label>
        							<select class="form-control"  id="subject" name="subject_id"><!--MSK-000116-subject-->		
     									<option>Select Subject</option>
									</select>
        						</div> 
                                <div class="form-group" id="divClassroom">
                					<label for="" >Classroom</label>
        							<select class="form-control"  id="classroom" name="classroom_id"><!--MSK-000116-classroom-->			
     									<option>Select Classroom</option>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM class_room";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     									<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?> 	           
									</select>
        						</div> 
                                <div class="form-group" id="divStartTime">
                					<label for="" >Start Time</label>
        							<input type="text" class="form-control" id="start_time" name="start_time"  placeholder="Enter start time" autocomplete="off"/>
        						</div>  
                                 <div class="form-group" id="divEndTime">
                					<label for="" >End Time</label>
        							<input type="text" class="form-control" id="end_time" name="end_time"  placeholder="Enter end time" autocomplete="off"/>
        						</div>  
            				</div><!--/.modal body-->
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden"  name="teacher_id" value="<?php echo $id; ?>"  />
            					<input type="hidden" name="do" value="add_timetable"  />
                                <input type="hidden" name="do2" value="add_timetable2"  />
                    			<button type="submit" class="btn btn-info " id="btnSubmit" style="width:100%;">Submit</button><!--MSK-000125-->
             				</div><!--/.panel-footer-->
             			</form>       
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.Modal-Add form -->