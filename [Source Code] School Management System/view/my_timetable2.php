<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>
<?php include_once('alert.php'); ?>

<style>

body { 
	overflow-y:scroll;
}

tbody tr{
	height:100px;	
}

.modal-content1 {
   position: absolute;
   left: 125px; 
}
@media only screen and (max-width: 500px) {

	.modal-content1 {
   		
		position:static;
   
	}
}

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
}
.set-color-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
	 background-color:red;
}
.image-error{
	border:1px solid #f44336;
	
}

.image-success{
	border:1px solid #009900;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}

body.modal-open-noscroll1
{
    overflow:hidden;
	
 
}
/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Timetable
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Timetable</a></li>
            <li><a href="#">My Timetable</a></li>
    	</ol>
	</section>
    
	<!-- table for view all records -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
                <div class="box">
                    <div class="box-header">
                    
<?php $index=$_SESSION["index_number"]; ?> 
   
                        <a href="#" onClick="showModal(this)" class="btn btn-success btn-sm pull-right" data-id="<?php echo $index; ?>">Add <span class="glyphicon glyphicon-plus"></span></a><!--MSK-000113-->
                        <h3 class="box-title">My Timetable </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead style="color:white; background-color:#666;">
                                <th class="col-md-1">Time</th>
                                <th class="col-md-1">Sunday</th>
                                <th class="col-md-1">Monday</th>
                                <th class="col-md-1">Tuesday</th>
                                <th class="col-md-1">Wednesday</th>
                                <th class="col-md-1">Thursday</th>
                                <th class="col-md-1">Friday</th>
                                <th class="col-md-1">Saturday</th>
                             </thead>
                             <tbody>
                                
<?php
include_once('../controller/config.php');
            
$index=$_SESSION["index_number"];
$current_year=date('Y');
            
$sql1="SELECT * FROM teacher WHERE index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id'];
            
$sql2="SELECT 
       DISTINCT start_time,end_time
       FROM
          timetable
       WHERE
          teacher_id='$id'  
       ORDER BY
          start_time";
       $result2=mysqli_query($conn,$sql2);
            
       while($row2=mysqli_fetch_assoc($result2)){
       		$s_time=$row2['start_time'];
            $e_time=$row2['end_time'];
                    
?>    
                                <tr id="<?php echo $s_time; ?>_<?php echo $e_time; ?>">
                                    <th  style="color:white; background-color:#666;">
                                        <?php echo $s_time.' - '.$e_time; ?>		
                                    </th>
                                     <td>
<?php 
include_once('../controller/config.php');
            
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Sunday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 1#
	while($row=mysqli_fetch_assoc($result)){ // while loop 1#
                    
?>    	
                                  
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                        
<?php }//end of the while loop 1# ?>
                
                                    </td>
<?php	
}else{	// 1#
            
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Sunday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
            
} 
            
?>
                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Monday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 2#
	while($row=mysqli_fetch_assoc($result)){ // while loop 2#
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                    
<?php } // end of the while loop 2# ?>
                                    </td>
<?php 
}else{// 2#	
            
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Monday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
                
} 
            
?>
                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Tuesday'";
                  
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0) { // 3#
	while($row=mysqli_fetch_assoc($result)){ // while loop 3#
            
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                
<?php  } // end of the while loop 3# ?>
                                    </td>
<?php	
}else{ // 3#
	
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Tuesday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday

} 
            
?>

                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Wednesday'";
            
$result=mysqli_query($conn,$sql);	  
if (mysqli_num_rows($result) > 0) { // 4#
	while($row=mysqli_fetch_assoc($result)){ // while loop 4# 
                
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                    
<?php } // end of the while loop 4#  ?>
                                    </td>
<?php	
}else{ // 4#
                    
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Wednesday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
                
} 
            
?>

                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Thursday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { //5#
	while($row=mysqli_fetch_assoc($result)){ // while loop 5#
            
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                       <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                    
<?php } // end of the while loop 5# ?>

                                    </td>
                
<?php
}else{ // 5#
	
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Thursday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
                    
} 
            
?>
                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Friday'";
                  
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 6#
	while($row=mysqli_fetch_assoc($result)){// while loop 6#
            
?>    	
                                    
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                    
<?php  } // end of the while loop 6#  ?>
                                    </td>
<?php
}else{ // 6#
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Friday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
                
} 
            
?>
                                    <td>
<?php 
include_once('../controller/config.php');
                
$sql="select timetable.id as tt_id,subject.name as s_name,teacher.i_name as t_name,class_room.name as c_name
      from timetable
      inner join subject
      on timetable.subject_id=subject.id
      inner join teacher
      on timetable.teacher_id=teacher.id
      inner join class_room
      on timetable.classroom_id=class_room.id
      where timetable.teacher_id='$id' and timetable.start_time='$s_time' and timetable.end_time='$e_time' and timetable.day='Saturday'";
                 
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) { // 7#
	while($row=mysqli_fetch_assoc($result)){ // while loop 7#
                
?>    	
                                        <?php echo $row['s_name']; ?><br>
                                        <?php echo $row['t_name']; ?><br>
                                        <?php echo $row['c_name']; ?><br>
                                        <a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $row['tt_id']; ?>,<?php echo $index; ?>" data-toggle="modal">Edit</a><br><!--MSK-00131-Sunday-->  
                 <!--MSK-00150-Sunday--><a href="#" class="confirm-delete btn btn-danger btn-xs" data-id="<?php echo $row['tt_id']; ?>">Delete</a><br>
                                    
<?php } // end of the while loop 7#   ?>
                                    </td>
<?php
}else{ // 7#	
            
	echo'<br><br><br><a id="a1" href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="Saturday,'.$index.'" data-toggle="modal">Add 	         <span class="glyphicon glyphicon-plus"></span></a>';//MSK-00129-Sunday
                
} 
            
?>							
                                    
                                </tr>
<?php 
}
?>   
                                
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->	
                </div><!-- /.box -->
            </div><!-- /.col-md-10 -->
        </div>
     </section>   
     
    <!-- //MSK-000118 Modal- modalInsertform-->    
	<div id="divAddtt">

	</div>       
    
<script>
function showModal(Insertform){
//MSK-000114	
	var index = $(Insertform).data("id"); 
	
	var xhttp = new XMLHttpRequest();//MSK-000115-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
									
				document.getElementById('divAddtt').innerHTML = this.responseText;//MSK-000117
				$("#modalInsertform").modal('show');//MSK-000119  
	
				$("#grade").change(function() {//MSK-000120
					
					var grade = document.getElementById("grade").value;
					
					var xhttp1 = new XMLHttpRequest();//MSK-00121-Ajax Start  
  						xhttp1.onreadystatechange = function() {
	
    						if (this.readyState == 4 && this.status == 200) {	
									
								document.getElementById('subject').innerHTML = this.responseText;//MSK-000123
										
    						}
			
  						};	
						
    					xhttp1.open("GET", "../model/get_subject_timetable.php?grade="+grade + "&index="+index, true);												
  						xhttp1.send();//MSK-00121-Ajax End
	
				});
				
				$("form").submit(function (e) {
				//MSK-000126-form submit
				
					var day = $('#day').val();
					var grade = $('#grade').val();
					var subject = $('#subject').val();
					var classroom = $('#classroom').val();
					var start_time = $('#start_time').val();	
					var end_time = $('#end_time').val();	
				
					if(day == 'Select Day'){
						//MSK-00127-day 
						$("#btnSubmit").attr("disabled", true);
						$('#divDay').addClass('has-error has-feedback');
						$('#divDay').append('<span id="spanDay" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The day is required" ></span>');	
					
						$("#day").change(function() {
							//MSK-00128-day  
							$("#btnSubmit").attr("disabled", false);	
							$('#divDay').removeClass('has-error has-feedback');
							$('#spanDay').remove();
						
						});
				
					}else{
					
					}
					
					if(grade == 'Select Grade'){
						//MSK-00127teacher  
						$("#btnSubmit").attr("disabled", true);
						$('#divGrade').addClass('has-error has-feedback');
						$('#divGrade').append('<span id="spanGrade" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The grade is required" ></span>');	
					
						
						$("#grade").change(function() {
							//MSK-00128-teacher  
							$("#btnSubmit").attr("disabled", false);	
							$('#divGrade').removeClass('has-error has-feedback');
							$('#spanGrade').remove();
							$('#divSubject').removeClass('has-error has-feedback');
							$('#spanSubject').remove();
						
						});
				
					}else{
					
					}
					
					if(subject == 'Select Subject'){
						//MSK-00127-subject       
						$("#btnSubmit").attr("disabled", true);
						$('#divSubject').addClass('has-error has-feedback');
						$('#divSubject').append('<span id="spanSubject" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The subject is required" ></span>');	
					
						$("#subject").change(function() {
							//MSK-00128-subject
							$("#btnSubmit").attr("disabled", false);	
							$('#divSubject').removeClass('has-error has-feedback');
							$('#spanSubject').remove();
						
						});
				
					}else{
					
					}
					
					if(classroom == 'Select Classroom'){
						//MSK-00127-classroom
						$("#btnSubmit").attr("disabled", true);
						$('#divClassroom').addClass('has-error has-feedback');
						$('#divClassroom').append('<span id="spanClassroom" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The classroom is required" ></span>');	
					
						$("#classroom").change(function() {
							//MSK-00128-classroom
							$("#btnSubmit").attr("disabled", false);	
							$('#divClassroom').removeClass('has-error has-feedback');
							$('#spanClassroom').remove();
						
						});
				
					}else{
					
					}
					
					if(start_time == ''){
						//MSK-00127-start time  
						$("#btnSubmit").attr("disabled", true);
						$('#divStartTime').addClass('has-error has-feedback');
						$('#divStartTime').append('<span id="spanStartTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The start time is required" ></span>');	
					
						$("#start_time").keydown(function() {
							//MSK-00128-start time 
							$("#btnSubmit").attr("disabled", false);	
							$('#divStartTime').removeClass('has-error has-feedback');
							$('#spanStartTime').remove();
						
						});
				
					}else{
					
					}
				
					if(end_time == ''){
						//MSK-00127-end time  
						$("#btnSubmit").attr("disabled", true);
						$('#divEndTime').addClass('has-error has-feedback');
						$('#divEndTime').append('<span id="spanEndTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The end time is required" ></span>');	
					
						$("#end_time").keydown(function() {
							//MSK-00128-end time       
							$("#btnSubmit").attr("disabled", false);	
							$('#divEndTime').removeClass('has-error has-feedback');
							$('#spanEndTime').remove();
						
						});
				
					}else{
					
					}
				
					if(day == 'Select Day' || grade == 'Select Grade' || subject == 'Select Subject' || classroom == 'Select Classroom' || start_time == '' || end_time == '' ){
						//MSK-000126- form validation failed
						$("#btnSubmit").attr("disabled", true);
						e.preventDefault();
						return false;
							
					}else{
						$("#btnSubmit").attr("disabled", false);
						//return true;
					}

				});
						
    		}
			
  		};	
		
    	xhttp.open("GET", "timetable_insert_form2.php?index="+index , true);												
  		xhttp.send();//MSK-000115-Ajax End
	
};

function showModal1(time){
//MSK-000114	

	//var index = $(Insertform).data("id"); 
	var myArray = $(time).closest('a').data("id").split(',');
	var myArray1 = $(time).closest('tr').attr('id').split('_');
	
	var index=myArray[1];
	
	var xhttp = new XMLHttpRequest();//MSK-000115-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
									
				document.getElementById('divAddtt').innerHTML = this.responseText;//MSK-000117
				$("#modalInsertform").modal('show');//MSK-000119 
				
				document.getElementById("start_time").value=myArray1[0];
				document.getElementById("end_time").value=myArray1[1];
				document.getElementById("day").value=myArray[0]; 
	
				$("#grade").change(function() {//MSK-000120
					
					var grade = document.getElementById("grade").value;
					
					var xhttp1 = new XMLHttpRequest();//MSK-00121-Ajax Start  
  						xhttp1.onreadystatechange = function() {
	
    						if (this.readyState == 4 && this.status == 200) {	
									
								document.getElementById('subject').innerHTML = this.responseText;//MSK-000123
										
    						}
			
  						};	
						
    					xhttp1.open("GET", "../model/get_subject_timetable.php?grade="+grade + "&index="+index, true);												
  						xhttp1.send();//MSK-00121-Ajax End
	
				});
				
				$("form").submit(function (e) {
				//MSK-000126-form submit
				
					var day = $('#day').val();
					var grade = $('#grade').val();
					var subject = $('#subject').val();
					var classroom = $('#classroom').val();
					var start_time = $('#start_time').val();	
					var end_time = $('#end_time').val();	
				
					if(day == 'Select Day'){
						//MSK-00127-day 
						$("#btnSubmit").attr("disabled", true);
						$('#divDay').addClass('has-error has-feedback');
						$('#divDay').append('<span id="spanDay" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The day is required" ></span>');	
					
						$("#day").change(function() {
							//MSK-00128-day  
							$("#btnSubmit").attr("disabled", false);	
							$('#divDay').removeClass('has-error has-feedback');
							$('#spanDay').remove();
						
						});
				
					}else{
					
					}
					
					if(grade == 'Select Grade'){
						//MSK-00127teacher  
						$("#btnSubmit").attr("disabled", true);
						$('#divGrade').addClass('has-error has-feedback');
						$('#divGrade').append('<span id="spanGrade" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The grade is required" ></span>');	
					
						
						$("#grade").change(function() {
							//MSK-00128-teacher  
							$("#btnSubmit").attr("disabled", false);	
							$('#divGrade').removeClass('has-error has-feedback');
							$('#spanGrade').remove();
							$('#divSubject').removeClass('has-error has-feedback');
							$('#spanSubject').remove();
						
						
						});
				
					}else{
					
					}
					
					if(subject == 'Select Subject'){
						//MSK-00127-subject       
						$("#btnSubmit").attr("disabled", true);
						$('#divSubject').addClass('has-error has-feedback');
						$('#divSubject').append('<span id="spanSubject" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The subject is required" ></span>');	
					
						$("#subject").change(function() {
							//MSK-00128-subject
							$("#btnSubmit").attr("disabled", false);	
							$('#divSubject').removeClass('has-error has-feedback');
							$('#spanSubject').remove();
						
						});
				
					}else{
					
					}
					
					if(classroom == 'Select Classroom'){
						//MSK-00127-classroom
						$("#btnSubmit").attr("disabled", true);
						$('#divClassroom').addClass('has-error has-feedback');
						$('#divClassroom').append('<span id="spanClassroom" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The classroom is required" ></span>');	
					
						$("#classroom").change(function() {
							//MSK-00128-classroom
							$("#btnSubmit").attr("disabled", false);	
							$('#divClassroom').removeClass('has-error has-feedback');
							$('#spanClassroom').remove();
						
						});
				
					}else{
					
					}
					
					if(start_time == ''){
						//MSK-00127-start time  
						$("#btnSubmit").attr("disabled", true);
						$('#divStartTime').addClass('has-error has-feedback');
						$('#divStartTime').append('<span id="spanStartTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The start time is required" ></span>');	
					
						$("#start_time").keydown(function() {
							//MSK-00128-start time 
							$("#btnSubmit").attr("disabled", false);	
							$('#divStartTime').removeClass('has-error has-feedback');
							$('#spanStartTime').remove();
						
						});
				
					}else{
					
					}
				
					if(end_time == ''){
						//MSK-00127-end time  
						$("#btnSubmit").attr("disabled", true);
						$('#divEndTime').addClass('has-error has-feedback');
						$('#divEndTime').append('<span id="spanEndTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The end time is required" ></span>');	
					
						$("#end_time").keydown(function() {
							//MSK-00128-end time       
							$("#btnSubmit").attr("disabled", false);	
							$('#divEndTime').removeClass('has-error has-feedback');
							$('#spanEndTime').remove();
						
						});
				
					}else{
					
					}
				
					if(day == 'Select Day' || grade == 'Select Grade' || subject == 'Select Subject' || classroom == 'Select Classroom' || start_time == '' || end_time == '' ){
						//MSK-000126- form validation failed
						$("#btnSubmit").attr("disabled", true);
						e.preventDefault();
						return false;
							
					}else{
						$("#btnSubmit").attr("disabled", false);
						//return true;
					}

				});
						
    		}
			
  		};	
		
    	xhttp.open("GET", "timetable_insert_form2.php?index="+index , true);												
  		xhttp.send();//MSK-000115-Ajax End
	
};

</script>

    <div id="divUpdatett"><!--MSK-000138-->
    
    </div>

<script>
function showModal2(Updateform){
//MSK-000132
	
	var myArray = $(Updateform).data("id").split(',');
	
	var Id = myArray[0];
	var index = myArray[1];
	
	var xhttp = new XMLHttpRequest();//MSK-00133-Ajax Start  
		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
									
				var myArray1 = eval( xhttp.responseText );
				
				var xhttp2 = new XMLHttpRequest();//MSK-00135-Ajax Start  
  					xhttp2.onreadystatechange = function() {
	
						if (this.readyState == 4 && this.status == 200) {	
										
							document.getElementById('divUpdatett').innerHTML = this.responseText;//MSK-000137
							$("#modalUpdateform").modal('show');//MSK-000139
							
							//MSK-000140
							document.getElementById("id1").value=myArray1[0];
							document.getElementById("day1").value=myArray1[1];
							document.getElementById("subject1").value=myArray1[2];
							document.getElementById("classroom1").value=myArray1[4];
							document.getElementById("start_time1").value=myArray1[5];
							document.getElementById("end_time1").value=myArray1[6];
							document.getElementById("grade1").value=myArray1[7];
							$("#grade1").change(function() {//MSK-000141
							
								var grade = document.getElementById("grade1").value;
								
								var xhttp1 = new XMLHttpRequest();//MSK-00142-Ajax Start  
  									xhttp1.onreadystatechange = function() {
	
    								if (this.readyState == 4 && this.status == 200) {	
									
										document.getElementById('subject1').innerHTML = this.responseText;//MSK-000144
										
    								}
			
  								};	
							
    							xhttp1.open("GET", "../model/get_subject_timetable.php?grade="+grade + "&index="+index, true);												
  								xhttp1.send();//MSK-00142-Ajax End
	
							});
							
							$("form").submit(function (e) {//MSK-000147-form submit
							
								var day = $('#day1').val();
								var grade = $('#grade1').val();	
								var subject = $('#subject1').val();
								var classroom = $('#classroom1').val();
								var start_time = $('#start_time1').val();	
								var end_time = $('#end_time1').val();	
											
								if(subject == 'Select Subject'){
									//MSK-00148-teacher  
									$("#btnSubmit1").attr("disabled", true);
									$('#divUpdateSubject').addClass('has-error has-feedback');
									$('#divUpdateSubject').append('<span id="spanUpdateSubject" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The subject is required" ></span>');	
								
									$("#subject1").change(function() {
										//MSK-00149-teacher  
										$("#btnSubmit1").attr("disabled", false);	
										$('#divUpdateSubject').removeClass('has-error has-feedback');
										$('#spanUpdatSubject').remove();
									
									});
							
								}else{
								
								}
								
								if(start_time == ''){
									//MSK-00148-start time  
									$("#btnSubmit1").attr("disabled", true);
									$('#divUpdateSTime').addClass('has-error has-feedback');
									$('#divUpdateSTime').append('<span id="spanUpdateSTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The start time is required" ></span>');	
								
									$("#start_time1").keydown(function() {
										//MSK-00149-start time 
										$("#btnSubmit1").attr("disabled", false);	
										$('#divUpdateSTime').removeClass('has-error has-feedback');
										$('#spanUpdateSTime').remove();
									
									});
							
								}else{
								
								}
					
								if(end_time == ''){
									//MSK-00148-end time  
									$("#btnSubmit1").attr("disabled", true);
									$('#divUpdateETime').addClass('has-error has-feedback');
									$('#divUpdateETime').append('<span id="spanUpdateETime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The end time is required" ></span>');	
								
									$("#end_time1").keydown(function() {
										//MSK-00149-end time       
										$("#btnSubmit1").attr("disabled", false);	
										$('#divUpdateETime').removeClass('has-error has-feedback');
										$('#spanUpdateETime').remove();
									
									});
							
								}else{
								
								}
					
								if(subject == 'Select Subject' ||  start_time == '' || end_time == '' ){
									//MSK-000147-form validation failed
									$("#btnSubmit1").attr("disabled", true);
									e.preventDefault();
									return false;
										
								}else{
									$("#btnSubmit1").attr("disabled", false);
									//return true;
								}
								
							});
							
						}
			
  					};	
							
    				xhttp2.open("GET", "timetable_update_form2.php?index="+index , true);												
  					xhttp2.send();//MSK-00135-Ajax End						
    			}
			
		};
			
		xhttp.open("GET", "../model/get_timetable.php?id="+Id , true);												
  		xhttp.send();//MSK-00133-Ajax End
	
};

</script>

	<!-- //MSK-000153 Modal-Delete Confirm Popup -->
	<div class="modal fade " id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to Delete this Record
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYes" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000154 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>
          
<script>

$('body').on('click', '.confirm-delete', function (e){//MSK-000151
	e.preventDefault();
    var id = $(this).data('id');
	$('#deleteConfirm').data('id1', id).modal('show');//MSK-000152
});

$('#btnYes').click(function() {//MSK-000155
	
    var id = $('#deleteConfirm').data('id1');
	
	var do1 = "delete_record";	
	var table_name1= "timetable";//give data table name
		
	var info = $('#example3').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var xhttp = new XMLHttpRequest();//MSK-000156-Ajax Start  
		xhttp.onreadystatechange = function() {
			
    	if (this.readyState == 4 && this.status == 200) {
			//MSK-000157	
			var myArray = eval(xhttp.responseText);
					
				if(myArray[0]==1){//MSK-000158
				
					$("#deleteConfirm").modal('hide');	
					Delete_alert(myArray[0]);  
					//window.location.reload();    		
					
				}
		
				if(myArray[0]==2){//MSK-000163
			
					$("#deleteConfirm").modal('hide');
					Delete_alert(myArray[0]);//MSK-000164
				
				}

    		}
			
  		};
			
		xhttp.open("GET", "../model/delete_record.php?id=" + id + "&do="+do1 + "&table_name="+table_name1 + "&page="+currentPage , true);												
  		xhttp.send();//MSK-000156-Ajax End
	 			   		
});

function Delete_alert(msg){//MSK-000162
	
	if(msg==1){
		
    	var myModal = $('#delete_Success');
		myModal.modal('show');
		
		clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
			
    	}, 3000));
			
	}
	
	if(msg==2){
		
    	var myModal = $('#connection_Problem');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}

};	

	
</script>     

<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>  
    
</div><!-- /.content-wrapper -->  
                           
<?php include_once('footer.php');?>   