<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<!--*****Insert Student Subjects***** -->   
<div class="modal msk-fade" id="modalViewSubject" tabindex="-1" role="dialog" aria-labelledby="tt3" aria-hidden="true" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog ">
    	<div class="container  "><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-6">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               	
                            <button type="button" onClick="showModalGrade()" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button><!--MSK-000128-->
                            
          					<h3 class="panel-title">Add Student Subject</h3>
   						</div>
            			<div class="panel-body"> <!-- Start of modal body--> 
               				<table id="" class="table ">
                                <thead>
                                    <th></th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Fee($)</th>
                                </thead>
                        		<tbody>
<?php 
include_once('../controller/config.php');
if(isset($_GET["do"])&&($_GET["do"]=="view_subject")){
$id=$_GET['id'];
$index=$_GET['index'];
$sql="select subject_routing.id as sr_id,subject.name as s_name,teacher.i_name as t_name,subject_routing.fee as sr_fee
from subject_routing
inner join subject
on subject_routing.subject_id=subject.id
inner join teacher
on subject_routing.teacher_id=teacher.id
where subject_routing.grade_id='$id'";

$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
?>
                                    <tr>
                                        <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $row["sr_id"]; ?>" data-id="<?php echo $index; ?>"></td>
                                        <td><?php echo $row['s_name']; ?></td>
                                        <td><?php echo $row['t_name']; ?></td>
                                        <td><?php echo $row['sr_fee']; ?></td>
                                    </tr>
<?php } } ?>                            
                        		</tbody>
                			</table>
            			</div><!--/.modal body-->
            			<div class="panel-footer bg-blue-active">
                        	<input type="hidden" id="index1" value="<?php echo $index; ?>" >
                        	<input type="hidden" id="grade1" value="<?php echo $id; ?>" >
                    		<button type="button" class="btn btn-info " id="btnSubmit1" onClick="insertSubject(this)" style="width:100%;" data-id="<?php echo $id; ?>"><span class="glyphicon glyphicon-ok-sign"></span>Submit</button><!--MSK-000130-->
             			</div>
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.Modal-Add form -->