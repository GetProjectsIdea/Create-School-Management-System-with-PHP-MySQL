<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<!-- //MSK-00103 Modal-modalUpdateform1-->  
<div class="modal msk-fade" id="modalUpdateform1" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<!-- Modal content-->
    	<div class="container modal-content1 "><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-3">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<?php
//MSK-00096
include_once('../controller/config.php');
$grade_id=$_GET['grade'];
$page=$_GET['page'];

$sql="SELECT * FROM grade where id='$grade_id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
?>                             
          					<h3 class="panel-title"><?php echo $name; ?> Exam Routing</h3>
   						</div>
            			<div class="panel-body"><!-- panel-body--> 
                            
 							<a href="#" style="float:right;" onClick="showeMark('<?php echo $grade_id; ?>','<?php echo $page; ?>')" class="btn btn-success btn-xs text-right">Add eMark</a><br>
                            <div class="form-group">
                            	<table id="tableU_mark_range" class="table">
                                	<thead>
                                    	<th class="col-md-1">Range</th>
                                        <th class="col-md-1">Grade</th>
                                        <th class="col-md-1">Action</th>
                                    </thead>	
                                    <tbody class="tBodyU">
<?php
//MSK-00097
include_once('../controller/config.php');
$grade_id=$_GET['grade'];

$count=0;
$sql="SELECT * FROM exam_range_grade WHERE grade_id='$grade_id'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?>                                        
                                    	<tr id="trU_<?php echo $count; ?>">
                                        	<td  id="rangeU_td_<?php echo $count; ?>"><?php echo $row['mark_range']; ?></td>
                                            <td  id="gradeU_td_<?php echo $count; ?>"><?php echo $row['mark_grade']; ?></td>
                                            <td id="action_<?php echo $count; ?>">
                                            	<a href="#" id="edit_RG_<?php echo $count; ?>" onClick="editRangeGrade(this)" data-id="<?php echo $row['id']; ?>,<?php echo $count; ?>" class="label-warning "><span class="glyphicon glyphicon-edit "></span></a>
                                  <a href="#" id="delete_RG_<?php echo $count; ?>" class="confirm-delete-RG label-danger" data-id="<?php echo $row['id']; ?>" class="label-warning "><span class="glyphicon glyphicon-remove "></span></a>
                                     		</td>
                                        </tr>
<?php }} ?> 
                                    </tbody>
                                 </table>
                            </div>        
            			</div><!--/.panel-body-->
            			<div class="panel-footer bg-blue-active">
                        
             			</div><!--/.panel-footer-->
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalUpdateform -->

