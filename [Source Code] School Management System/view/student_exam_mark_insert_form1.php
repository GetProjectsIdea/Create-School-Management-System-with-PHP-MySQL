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
           		<div class="col-md-4">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add Exam Marks</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="formExam">
            				<div class="panel-body"> <!-- Start of modal body--> 
                                <div class="form-group " id="divExamSubject">
                                    <table id="table_student_exam" class="table">
                                        <thead>
                                            <th class="col-md-2">Subject</th>
                                            <th class="col-md-1">Marks</th>
                                        </thead>
                                        <tbody class="tBody">
<?php
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$exam_id=$_GET['exam'];
$std_index=$_GET['std_index'];
$current_page=$_GET['page'];
$current_year=date('Y');
$count=0;
	
$sql="select subject.id as s_id,subject.name as s_name
      from student_subject
	  inner join subject_routing
	  on student_subject.sr_id=subject_routing.id
	  inner join subject
	  on subject_routing.subject_id=subject.id
	  where student_subject.index_number='$std_index' and student_subject.year='$current_year' and student_subject._status='' and  	subject_routing.grade_id='$grade_id'";
	  
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){	  	  

		$count++;
?> 		
		<tr id="tr_<?php echo $count; ?>">
        	<input type="hidden" name="subject_id[]" id="eSubject_id_<?php echo $count; ?>" value="<?php echo $row['s_id']; ?>">
            <input type="hidden" name="grade" value="<?php echo $grade_id; ?>"/>
            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>"/>
        	<td id="eSubject_td_<?php echo $count; ?>"><?php echo $row['s_name']; ?></td>
            <td id="eMark_td_<?php echo $count; ?>"><input type="text" name="exam_mark[]" id="exam_mark_<?php echo $count; ?>"></td>
        </tr>
<?php	}?>
                                        </tbody>
                                    </table>
                            	</div> 
            				</div><!--/.modal body-->
            				<div class="panel-footer bg-blue-active">
                            	<input type="hidden" name="current_page" value="<?php echo $current_page; ?>"/>
                            	<input type="hidden" name="std_index" value="<?php echo $std_index; ?>"/>
            					<input type="hidden" name="do" value="add_student_exam_mark1"/>
                    			<button type="submit" class="btn btn-info btnS" id="btnSubmit3" style="width:100%;">Submit</button>
             				</div>
             			</form>      
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->