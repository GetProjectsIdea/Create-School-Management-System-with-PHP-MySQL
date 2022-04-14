<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
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
        	Exam Timetable
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Exam Timetabe</a></li>
        </ol>
	</section>

	<!-- Main content -->
    <section class="content">
    	<div class="row">
            <div class="col-md-5"><!-- left column -->
              	<div class="box box-primary"><!-- general form elements -->
                	<div class="box-header with-border">
                  		<h3 class="box-title">Add Exam Timetable</h3>
                	</div><!-- /.box-header -->
                  	<div class="box-body">
                    	<div class="form-group col-md-5" id="divGender1">
                        	<label>Grade</label>
                    		<select name="grade" class="form-control col-md-3" id="grade" ><!--MSK-000107-->
                    			<option>Select Grade</option>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM grade";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     							<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
					  		</select>
                     	</div>
                        <div class="form-group col-md-5" id="divGender1">
                        	<label>Exam</label>
                    		<select name="exam" class="form-control " id="exam" ><!--MSK-000107-->
                    			<option>Select Exam</option>
<?php
include_once('../controller/config.php');
$sql="SELECT * FROM exam";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     							<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?>
					  		</select>
                     	</div>
                        
                  	</div><!-- /.box-body -->
                  	<div class="box-footer">
                    	<button type="button" class="btn btn-primary"  onClick="showExamTimetable(this)">Next</button><!--MSK-000108-->
                  	</div>
            	</div><!-- /.box -->
        	</div>
    	</div>
	</section><!-- End of form section -->

	<!-- table for view all records-->
    <section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000112--> 
           
        </div>
    </section> <!-- End of table section --> 
        
<script>
function showExamTimetable(){
//MSK-000109
	
	var grade = document.getElementById("grade").value;
	var exam = document.getElementById("exam").value;
			
	var do1 ="show_exam_Timetable";
	
	var xhttp = new XMLHttpRequest();//MSK-000110-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000111
										
    		}
			
  		};
			
    	xhttp.open("GET", "exam_timetable_grade_wise.php?grade="+grade +  "&exam="+exam +  "&do="+do1 , true);												
  		xhttp.send();//MSK-000110-End Ajax
	
};

function showExamTimetable1(grade,exam){//MSK-000143-8
	
	var do1 ="show_exam_Timetable";
	
	var xhttp = new XMLHttpRequest();//MSK-00143-9-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
					
				document.getElementById('table1').innerHTML = this.responseText;//MSK-000143-10
				window.scrollTo(0,document.body.scrollHeight);
										
    		}
			
  		};
			
    	xhttp.open("GET", "exam_timetable_grade_wise.php?grade="+grade + "&exam="+exam + "&do="+do1 , true);												
  		xhttp.send();//MSK-00143-9-Ajax End
	
};

</script>

	<!-- //MSK-000118 Modal- modalInsertform-->    
	<div id="divAddEtt">

	</div>       
    
<script>
function showModal(Insertform){
//MSK-000114	
	var myArray = $(Insertform).data("id").split(','); 
	
	var grade = myArray[0];
	var exam = myArray[1];

	var xhttp = new XMLHttpRequest();//MSK-000115-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
									
				document.getElementById('divAddEtt').innerHTML = this.responseText;//MSK-000117
				$("#modalInsertform").modal('show');//MSK-000119  
				
				$("form").submit(function (e) {
				//MSK-000126-form submit
				
					var day = $('#day').val();
					var subject = $('#subject').val();
					var teacher = $('#teacher').val();	
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
				
					if(day == 'Select Day' || subject == 'Select Subject' || classroom == 'Select Classroom' || start_time == '' || end_time == '' ){
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
		
    	xhttp.open("GET", "exam_timetable_insert_form.php?grade="+grade + "&exam="+exam , true);												
  		xhttp.send();//MSK-000115-Ajax End
	
};

function showModal1(time){
//MSK-000130 

	var myArray = $(time).closest('a').data("id").split(',');
	var myArray1 = $(time).closest('tr').attr('id').split('_');
	
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {	
									
				document.getElementById('divAddEtt').innerHTML = this.responseText;
				$("#modalInsertform").modal('show');
	
				document.getElementById("start_time").value=myArray1[0];
				document.getElementById("end_time").value=myArray1[1];
				document.getElementById("day").value=myArray[0];
					
					$("form").submit(function (e) {
						
						var day = $('#day').val();
						var subject = $('#subject').val();
						var teacher = $('#teacher').val();	
						var classroom = $('#classroom').val();
						var start_time = $('#start_time').val();	
						var end_time = $('#end_time').val();	
					
						if(day == 'Select Day'){
						
							$("#btnSubmit").attr("disabled", true);
							$('#divDay').addClass('has-error has-feedback');
							$('#divDay').append('<span id="spanDay" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The day is required" ></span>');	
						
							
							$("#day").change(function() {
							
								$("#btnSubmit").attr("disabled", false);	
								$('#divDay').removeClass('has-error has-feedback');
								$('#spanDay').remove();
							
							});
					
						}else{
						
						}
						
						if(subject == 'Select Subject'){
						
							$("#btnSubmit").attr("disabled", true);
							$('#divSubject').addClass('has-error has-feedback');
							$('#divSubject').append('<span id="spanSubject" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The subject is required" ></span>');	
						
							$("#subject").change(function() {
							
								$("#btnSubmit").attr("disabled", false);	
								$('#divSubject').removeClass('has-error has-feedback');
								$('#spanSubject').remove();
							
							});
					
						}else{
						
						}
						
						if(classroom == 'Select Classroom'){
						
							$("#btnSubmit").attr("disabled", true);
							$('#divClassroom').addClass('has-error has-feedback');
							$('#divClassroom').append('<span id="spanClassroom" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The classroom is required" ></span>');	
							
							$("#classroom").change(function() {
							
								$("#btnSubmit").attr("disabled", false);	
								$('#divClassroom').removeClass('has-error has-feedback');
								$('#spanClassroom').remove();
							
							});
					
						}else{
						
						}
						
						if(start_time == ''){
						
							$("#btnSubmit").attr("disabled", true);
							$('#divStartTime').addClass('has-error has-feedback');
							$('#divStartTime').append('<span id="spanStartTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The start time is required" ></span>');	
						
							$("#start_time").keydown(function() {
							
								$("#btnSubmit").attr("disabled", false);	
								$('#divStartTime').removeClass('has-error has-feedback');
								$('#spanStartTime').remove();
							
							});
					
						}else{
						
						}
					
						if(end_time == ''){
						
							$("#btnSubmit").attr("disabled", true);
							$('#divEndTime').addClass('has-error has-feedback');
							$('#divEndTime').append('<span id="spanEndTime" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The end time is required" ></span>');	
						
							$("#end_time").keydown(function() {
							
								$("#btnSubmit").attr("disabled", false);	
								$('#divEndTime').removeClass('has-error has-feedback');
								$('#spanEndTime').remove();
							
							});
					
						}else{
						
						}
					
						if(day == 'Select Day' || subject == 'Select Subject' || teacher == 'Select Teacher' || classroom == 'Select Classroom' || start_time == '' || end_time == '' ){
						
							$("#btnSubmit").attr("disabled", true);
							e.preventDefault();
							return false;
								
						}else{
							$("#btnSubmit").attr("disabled", false);
							//return true;
						}

					});//end of the form submit function
					
									
    			}
			
		};
			
		xhttp.open("GET", "exam_timetable_insert_form.php?grade="+myArray[1] + "&exam="+myArray[2] , true);												
  		xhttp.send();
	
};


</script>
  
<!--run Insert alert using PHP & JS/jQuery  -->          
<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert")){
//MSK-000143-6-PHP-JS-INSERT
  
	$msg=$_GET['msg'];
	$grade=$_GET['grade'];
	$exam=$_GET['exam'];
	
	if($msg==1){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-7-msg=1 
		
		echo"
			<script>
			
			var myModal = $('#duplicate_Record2');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}

	if($msg==2){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-7-msg=2 
		
		echo"
			<script>
			
			var myModal = $('#insert_Success');
			myModal.modal('show');

			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}

	if($msg==3){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-7-msg=3 
		
		echo"
			<script>
			
			var myModal = $('#connection_Problem');
			myModal.modal('show');
			
			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}
	
	
}
?><!--./Insert alert -->    


    <div id="divUpdatett"><!--MSK-000138-->
    
    </div>

<script>
function showModal2(Updateform){
//MSK-000132
	
	var myArray = $(Updateform).data("id").split(',');
	
	var Id = myArray[0];
	var grade = myArray[1];
	var exam = myArray[2];
	
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
							document.getElementById("classroom1").value=myArray1[3];
							document.getElementById("start_time1").value=myArray1[4];
							document.getElementById("end_time1").value=myArray1[5];
							
							
							$("form").submit(function (e) {//MSK-000147-form submit
							
								var start_time = $('#start_time1').val();	
								var end_time = $('#end_time1').val();	
											
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
					
								if(start_time == '' || end_time == '' ){
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
							
    				xhttp2.open("GET", "exam_timetable_update_form.php?grade="+grade + "&exam="+exam, true);												
  					xhttp2.send();//MSK-00135-Ajax End						
    			}
			
		};
			
		xhttp.open("GET", "../model/get_exam_timetable.php?id="+Id , true);												
  		xhttp.send();//MSK-00133-Ajax End
	
};

</script>

<!--run Update alert using PHP & JS/jQuery  -->          
<?php
//MSK-000143-U-18-PHP-JS-UPDATE
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_update")){
  
	$msg=$_GET['msg'];
	$grade=$_GET['grade'];
	$exam=$_GET['exam'];
	
	if($msg==1){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-U-18-msg=1 
		
		echo"
			<script>
			
			var myModal = $('#update_Success1');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}

	if($msg==2){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-U-18-msg=2 
		
		echo"
			<script>
			
			var myModal = $('#connection_Problem');
			myModal.modal('show');

			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}

	if($msg==3){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-U-18-msg=3 
		
		echo"
			<script>
			
			var myModal = $('#update_error1');
			myModal.modal('show');
			
			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}
	
	if($msg==4){
		
		echo '<script>','showExamTimetable1('.$grade.','.$exam.');','</script>';//MSK-000143-U-18-msg=4     
		
		echo"
			<script>
			
			var myModal = $('#duplicate_Record2');
			myModal.modal('show');
			
			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}
	
}
?><!--./Insert alert -->    
                       
	<!-- //MSK-000153 Modal-Delete Confirm Popup -->
	<div class="modal msk-fade " id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	
	var myArray3 = $('#deleteConfirm').data('id1').split(',');
     		
    var id = myArray3[0];
	var grade1 = myArray3[1];
	var exam1 = myArray3[2];
	
	var do1 = "delete_record";	
	var table_name1= "exam_timetable";//give data table name
		
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var xhttp = new XMLHttpRequest();//MSK-000156-Ajax Start  
		xhttp.onreadystatechange = function() {
			
    	if (this.readyState == 4 && this.status == 200) {
			//MSK-000157	
			var myArray = eval(xhttp.responseText);
					
				if(myArray[0]==1){//MSK-000158
				
					$("#deleteConfirm").modal('hide');	        		
					var do2 ="show_Timetable";
				
					var xhttp1 = new XMLHttpRequest();//MSK-000159-Start Ajax  
						xhttp1.onreadystatechange = function() {		
				
							if (this.readyState == 4 && this.status == 200) {
										
								document.getElementById('table1').innerHTML = this.responseText;//MSK-000160
								Delete_alert(myArray[0]);//MSK-000161
								window.scrollTo(0,document.body.scrollHeight);
							
							}
								
						};
						
						xhttp1.open("GET", "exam_timetable_grade_wise.php?grade=" + grade1 + "&exam="+exam1 + "&do="+do2 , true);												
  						xhttp1.send();//MSK-000159-End Ajax
				
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