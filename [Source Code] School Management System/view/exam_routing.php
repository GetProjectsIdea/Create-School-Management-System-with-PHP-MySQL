<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>

<style>

body { 
	overflow-y:scroll;
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

.msk-fade{  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

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
        	Exam
            <small>Routing</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Exam Routing</a></li>
        </ol>
	</section>

<!-- table for view all records -->
       
	<!-- Main content -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
            	<div class="box">
                	<div class="box-header">
                 		<a href="#modalInsertform" onClick="" class="btn btn-success btn-sm pull-right" data-toggle="modal">Add <span class="glyphicon glyphicon-plus"></span></a><!-- MSK-00094-->
                  		<h3 class="box-title">Exam Routing</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!-- MSK-00093-->
                		<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Grade</th>
                                <th class="col-md-1">Exam</th>
                                <th class="col-md-4">Subject</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                        	<tbody>
<?php
include_once('../controller/config.php');


$sql="SELECT 
	  DISTINCT grade_id,exam_id,subject_id
	  FROM
  		exam_routing  
	  ORDER BY
  		grade_id";	  
	  
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		
		$g_id=$row['grade_id'];
		$e_id=$row['exam_id'];
		$s_id=$row['subject_id'];
		
		$sql1="select distinct exam_routing.id as exr_id,grade.name as g_name,exam.name as e_name,subject.name as s_name
		from exam_routing
		inner join grade
		on exam_routing.grade_id=grade.id
		inner join exam
		on exam_routing.exam_id=exam.id
		inner join subject
		on exam_routing.subject_id=subject.id
		where exam_routing.grade_id='$g_id' and exam_routing.exam_id='$e_id' and exam_routing.subject_id='$s_id'";
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		
		
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row1['exr_id']; ?>"><?php echo $row1['g_name']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row1['exr_id']; ?>"><?php echo $row1['e_name']; ?></td>
               <!--MSK-000115-td3--><td id="td3_<?php echo $row1['exr_id']; ?>"><?php echo $row1['s_name']; ?></td>
                                    <td> 
<!--MSK-00102-->                                                
<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="<?php echo $row1['exr_id']; ?>" data-toggle="modal">View</a>
<!--MSK-00121-->
<a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="<?php echo $g_id; ?>,<?php echo $e_id; ?>,<?php echo $s_id; ?>">Delete</a>
                               		</td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div> 
    	</div><!-- ./row -->
	</section> <!-- End of table section --> 
    
    
 <!-- //MSK-00095 Modal- modalInsertform -->  
  
  <div class="modal msk-fade" id="modalInsertform" tabindex="-1" role="dialog" aria-labelledby="modalInsertform" aria-hidden="true">  
  	<div class="modal-dialog ">
    	<!-- Modal content-->
    	<div class="container modal-content1 "><!--modal-content --> 
      		<div class="row ">	
           		<div class="col-md-3">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add Exam Routing</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post" id="form1">
            				<div class="panel-body"> <!-- Start of modal body--> 
               					<div class="form-group" id="divGrade">
                					<label for="" >Grade</label>
        							<select class="form-control"  id="grade" name="grade_id">			
     									<option >Select Grade</option>
<?php
//MSK-00096
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
                                <div class="form-group" id="divExam">
                					<label for="" >Exam</label>
        							<select class="form-control"  id="exam" name="exam_id">			
     									<option>Select Exam</option>
<?php
//MSK-00098
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
                                <div class="form-group" id="divSubject">
                					<label for="" >Subject</label>
        							<select class="form-control"  id="subject" name="subject_id">			
     									<option>Select Subject</option>
<?php
//MSK-00097
include_once('../controller/config.php');
$sql="SELECT * FROM subject";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
     									<option value="<?php echo $row["id"]; ?>"><?php echo $row['name']; ?></option>
<?php }} ?> 	           
									</select>
        						</div> 
                                <div class="form-group" id="divMarkRange1">
                					<label for="" >Range & Grade</label>
                                     <a href="#" onClick="addNewRow(this)" class="btn btn-success btn-xs pull-right"><span class="glyphicon glyphicon-plus"></span></a><!-- MSK-00094--> 
                                     <a href="#" onClick="deleteRow(this)" class="btn btn-danger btn-xs pull-right" style="margin-right:2px;"><span class="glyphicon glyphicon-remove"></span></a><!-- MSK-00094-->
                                </div>
                                 <div class="form-group" id="divMarkRange2">
                                    <table id="table_mark_range">
                                       <tbody class="tBody">
                                        <tr id="tr_1">
                                            <td id="range_td_1"><input type="text" class="mark-range form-control" id="mark_range_text_1" name="mark_range[]"  placeholder="75-100" autocomplete="off"/></td>
                                            <td id="grade_td_1"><input type="text" class="mark-grade form-control" id="mark_grade_text_1" name="mark_grade[]"  placeholder="A" autocomplete="off"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                   
                            	</div>        
            				</div><!--/.modal body-->
            
            				<div class="panel-footer bg-blue-active">
            					<input type="hidden" name="do" value="add_exam_routing"  />
                    			<button type="submit" onClick="" class="btn btn-info btnS" id="btnSubmit" style="width:100%;">Submit</button>
             				</div>
             			</form>       
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->
   
<script>

function addNewRow(){
	
	var last_id = $('.tBody tr:last').attr('id').replace('tr_','');

		last_id++;
	
	var tr = '<tr id="tr_'+last_id+'">'+
          		'<td id="range_td_'+last_id+'"><input type="text" class="mark-range form-control" id="mark_range_text_'+last_id+'" name="mark_range[]"  placeholder="75-100" autocomplete="off"/></td> '+
                '<td id="grade_td_'+last_id+'"><input type="text" class="mark-grade form-control" id="mark_grade_text_'+last_id+'" name="mark_grade[]"  placeholder="A" autocomplete="off"/> </td>'+
         	'</tr>';
				
	$('.tBody').append(tr);

}; 

function deleteRow(){
	
	var last_id = $('.tBody tr:last').attr('id').replace('tr_','');

	if(last_id != 1){
		$('.tBody tr:last').remove();	
		$("#btnSubmit").attr("disabled", false); 
	}

}

$("#form1").submit(function (e) {
//$("#modalInsertform").on("click", ".btnS", function (e) {
	
	var grade = $('#grade').val();
	var subject = $('#subject').val();
	var exam = $('#exam').val();	

	if(grade == 'Select Grade'){
		//MSK-00100-grade  
		$("#btnSubmit").attr("disabled", true);
		$('#divGrade').addClass('has-error has-feedback');
		$('#divGrade').append('<span id="spanGrade" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The grade is required" ></span>');	
	
		$("#grade").change(function() {
			//MSK-00101-grade  
  			$("#btnSubmit").attr("disabled", false);	
			$('#divGrade').removeClass('has-error has-feedback');
			$('#spanGrade').remove();
		
		});

	}else{
	
	}
	
	if(subject == 'Select Subject'){
		//MSK-00100-subject
		$("#btnSubmit").attr("disabled", true);
		$('#divSubject').addClass('has-error has-feedback');
		$('#divSubject').append('<span id="spanSubject" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The subject is required" ></span>');	
	
		$("#subject").change(function() {
			//MSK-00101-subject
  			$("#btnSubmit").attr("disabled", false);	
			$('#divSubject').removeClass('has-error has-feedback');
			$('#spanSubject').remove();
		
		});

	}else{
	
	}
	
	if(exam == 'Select Exam'){
		//MSK-00100-teacher 
		$("#btnSubmit").attr("disabled", true);
		$('#divExam').addClass('has-error has-feedback');
		$('#divExam').append('<span id="spanExam" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The exam is required" ></span>');	
	
		$("#exam").change(function() {
			//MSK-00101-teacher 
  			$("#btnSubmit").attr("disabled", false);	
			$('#divExam').removeClass('has-error has-feedback');
			$('#spanExam').remove();
		
		});

	}else{
	
	}
	
	var rowCount = $('.tBody tr').length;
	
	for(i=1; i<rowCount+1; i++){
		
		var markRange = document.getElementById('mark_range_text_'+i).value;
		var markGrade = document.getElementById('mark_grade_text_'+i).value;

		if(markRange==""){
			$("#btnSubmit").attr("disabled", true); 
			$("#btnSubmit").attr("disabled", true);
			$("#range_td_"+i).addClass('has-feedback');
			$("#range_td_"+i).append('<span id="spanMarkRange" class="glyphicon glyphicon-remove form-control-feedback set-color-tooltip" data-toggle="tooltip" title="The mark range is required" ></span>');
			
			$("#mark_range_text_"+i).keydown(function(){
				$("#btnSubmit").attr("disabled", false); 
				$("#btnSubmit").attr("disabled", false);     
				$("#range_td_"+i).removeClass('has-feedback');
				$("#spanMarkRange").remove();
			});
			
		}
		
		if(markGrade==""){
			$("#btnSubmit").attr("disabled", true);
			$("#btnSubmit").attr("disabled", true);  
			$('#grade_td_'+i).addClass('has-feedback');
			$('#grade_td_'+i).append('<span id="spanMarkGrade" class="glyphicon glyphicon-remove form-control-feedback set-color-tooltip" data-toggle="tooltip" title="The mark grade is required" ></span>');
			
			$("#mark_grade_text_"+i).keydown(function(){
				$('#btnSubmit').attr("disabled", false); 
				$('#btnSubmit').attr("disabled", false);     
				$('#grade_td_'+i).removeClass('has-feedback');
				$("#spanMarkGrade").remove();
			});
		}
		
	}
	
	if(grade == 'Select Grade' || subject == 'Select Subject' || exam == 'Select Exam' || markRange == '' || markGrade == '' ){
		//MSK-000099- form validation failed
		
		$("#btnSubmit").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		$("#btnSubmit").attr("disabled", false);
		//return true;
		
	}
	
});
</script>   
          
<!--run Insert alert using PHP & JS/jQuery -->          
<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert")){
//MSK-000143-6-PHP-JS-INSERT
  
	$msg=$_GET['msg'];

	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#duplicate_Record1');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}

	if($msg==2){
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

    <div id="divUpdateSR">
    
    </div>

<script>

function showModal(Updateform){
//MSK-00104
	
	var Id = $(Updateform).data("id"); 
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				//MSK-00107 
				var myArray = eval( xhttp.responseText );
				
				var xhttp1 = new XMLHttpRequest();//MSK-00105-Ajax Start  
  					xhttp1.onreadystatechange = function() {
    		
						if (this.readyState == 4 && this.status == 200) {
							
							document.getElementById('divUpdateSR').innerHTML = this.responseText;//MSK-000137		
							$("#modalUpdateform").modal('show');//MSK-000139
							
							//document.getElementById("exr_id").value =myArray[0];
							//document.getElementById("grade1").value =myArray[1];
							//document.getElementById("exam1").value =myArray[2];
							//document.getElementById("subject1").value =myArray[3];
							
							
							$("#form2").submit(function (e) {
								
								//alert('ouw me ethana thamay');
								var rowCount = $('.tBodyU tr').length;
								//alert(rowCount);
								for(i=1; i<rowCount+1; i++){
									
									var markRange1 = document.getElementById('mark_range_textU_'+i).value;
									var markGrade1 = document.getElementById('mark_grade_textU_'+i).value;
									
								if(markRange1==""){
									
										$("#btnSubmit1").attr("disabled", true); 
										$("#btnSubmit1").attr("disabled", true);
										$("#rangeU_td_"+i).addClass('has-feedback');
										$("#rangeU_td_"+i).append('<span id="spanUMarkRange" class="glyphicon glyphicon-remove form-control-feedback set-color-tooltip" data-toggle="tooltip" title="The mark range is required" ></span>');
										
										$("#mark_range_textU_"+i).keydown(function(){
											$("#btnSubmit1").attr("disabled", false); 
											$("#btnSubmit1").attr("disabled", false);     
											$("#rangeU_td_"+i).removeClass('has-feedback');
											$("#spanUMarkRange").remove();
										});
										
									}
									
									if(markGrade1==""){
										$("#btnSubmit1").attr("disabled", true);
										$("#btnSubmit1").attr("disabled", true);  
										$('#gradeU_td_'+i).addClass('has-feedback');
										$('#gradeU_td_'+i).append('<span id="spanUMarkGrade" class="glyphicon glyphicon-remove form-control-feedback set-color-tooltip" data-toggle="tooltip" title="The mark grade is required" ></span>');
										
										$("#mark_grade_textU_"+i).keydown(function(){
											$('#btnSubmit1').attr("disabled", false); 
											$('#btnSubmit1').attr("disabled", false);     
											$('#gradeU_td_'+i).removeClass('has-feedback');
											$("#spanUMarkGrade").remove();
										});
									}
									if(markRange1 == '' || markGrade1 == '' ){
									//MSK-000099- form validation failed
									
									//$("#btnSubmit1").attr("disabled", true);
									e.preventDefault();
									return false;
									
										
								}else{
									//$("#btnSubmit1").attr("disabled", false);
									//return true;
									
									
								}
								}
								
	
							});
						
						}
				
					};	
							
    				xhttp1.open("GET", "exam_routing_update_form.php?grade="+myArray[1] + "&exam="+myArray[2] +"&subject="+myArray[3], true);												
  					xhttp1.send();//MSK-00135-Ajax End	
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/get_exam_routing.php?id=" + Id , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function editRangeGrade(id,count){
	
	var markRange= document.getElementById('rangeU_td_'+count).innerHTML;
	var markGrade= document.getElementById('gradeU_td_'+count).innerHTML;
	
	var do1="show_range_grade_text";
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
							
				document.getElementById('trU_'+count).innerHTML = this.responseText;//MSK-000137		
				$('#edit_RG_'+count).hide();
				
				$('#action_'+count).append('<a id="update_RG_'+count+'" onclick="updateRangeGrade('+id+','+count+')" class="glyphicon glyphicon-ok btn btn-success btn-xs" ></a>');			
			}
				
		};	
							
    	xhttp.open("GET", "range_grade_text.php?id="+id + "&count="+count +"&range="+markRange +"&grade="+markGrade +"&do="+do1, true);												
  		xhttp.send();//MSK-00135-Ajax End	
	
};

function updateRangeGrade(id,count){
	
var range = $('#rangeText_'+count).val();
var grade = $('#gradeText_'+count).val();

var do1="update_exam_routing";

	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg=myArray[0];
				
				if(msg == 1){
					$('#update_RG_'+count).remove();
					
					$('#rangeText_'+count).remove();
					$('#gradeText_'+count).remove();
					
					$('#rangeU_td_'+count).html(range);
					$('#gradeU_td_'+count).html(grade);
					
					 
					
					$('#action_'+count).append('<a href="#" id="edit_RG_'+count+'" onclick="editRangeGrade('+id+','+count+')" class="label-warning "><span class="glyphicon glyphicon-edit "></span></a>');
					
					
					
				}
							
						
			}
				
		};	
							
    	xhttp.open("GET", "../model/update_exam_routing.php?id="+id +"&range="+range +"&grade="+grade +"&do="+do1, true);												
  		xhttp.send();//MSK-00135-Ajax End




};

</script>
  
               

	

<script>

  
function UpdateSubjectFee(){
	
	var Id1 = document.getElementById('btnSubmit1').value;
	var grade = document.getElementById("grade1").value;
	var subject = document.getElementById("subject1").value;	
	var teacher = document.getElementById("teacher1").value;
	var fee = document.getElementById("fee1").value;
	
	
	if(fee == ''){
		//MSK-00109-fee 
		$("#btnSubmit1").attr("disabled", true);      
		$('#divFeeUpdate').addClass('has-error has-feedback');
		$('#divFeeUpdate').append('<span id="spanFeeUpdate"  class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The fee is required" ></span>');
			
		$("#fee1").keydown(function(){
			//MSK-00110-fee 
			$("#btnSubmit1").attr("disabled", false);      
			$('#divFeeUpdate').removeClass('has-error has-feedback');
			$('#spanFeeUpdate').remove();
			
		});
		
	}else{
			
		var xhttp = new XMLHttpRequest();//MSK-00111-Ajax Start  
  			xhttp.onreadystatechange = function() {
				
    			if (this.readyState == 4 && this.status == 200) {
					//MSK-000112
					var myArray2 = eval(xhttp.responseText);
					var msg=myArray2[4];
					
		    		if(msg==1){//MSK-000113
						
						//MSK-000114
						document.getElementById("td1_"+Id1 ).innerHTML =myArray2[0];
						document.getElementById("td2_"+Id1 ).innerHTML =myArray2[1];
						document.getElementById("td3_"+Id1 ).innerHTML =myArray2[2];
						document.getElementById("td4_"+Id1 ).innerHTML =myArray2[3];
						$("#modalUpdateform").modal('hide');
						Update_alert(msg);//MSK-000116
						
					}
			
					if(msg==2){//MSK-000118
						
						$("#modalUpdateform").modal('hide');
						Update_alert(msg);
						
					}
					
					if(msg==3){//MSK-000119
						
						$("#modalUpdateform").modal('hide');
						Update_alert(msg);
					
					}
					
					if(msg==4){//MSK-000120
						
						$("#modalUpdateform").modal('hide');
						Update_alert(msg);
					
					}

    			}
			
  		};
	
  		xhttp.open("GET", "../model/update_subject_routing.php?id=" + Id1 + "&grade="+grade + "&subject="+subject + "&teacher="+teacher+ "&fee="+fee , true);												
  		xhttp.send();//MSK-00111-Ajax End
				
	}

};

function Update_alert(msg){
//MSK-000117	
	if(msg==1){
		
    	var myModal = $('#update_Success');
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
	
	if(msg==3){
		
    	var myModal = $('#update_error1');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}
	
	if(msg==4){

    	var myModal = $('#duplicate_Record1');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}
	 
};

</script>

 <!-- //MSK-000124 Modal-Delete Confirm Popup -->
	<div class="modal msk-fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					<a href="#" style='margin-left:10px;' id="btnYes" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000125 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>
                
<script>

$('body').on('click', '.confirm-delete', function (e){
//MSK-000122		
    e.preventDefault();
    var id = $(this).data('id');
	$('#deleteConfirm').data('id1', id).modal('show');//MSK-000123
 
});

$('#btnYes').click(function() {
//MSK-000126
     			
	var myArray = $('#deleteConfirm').data('id1').split(',');
	alert(myArray);
	var grade = myArray[0];
	var exam = myArray[1];
	var subject = myArray[2];
	var do1 = "delete_exam_routing";	
	
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	alert(currentPage+'this is page');
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray1 = eval( xhttp.responseText );
				
				if(myArray1[0]==1){//MSK-000130
				
					$("#deleteConfirm").modal('hide');
						        		
					var page = myArray1[1];
				
					var xhttp1 = new XMLHttpRequest();//MSK-000131-Start Ajax  
						xhttp1.onreadystatechange = function() {		
				
							if (this.readyState == 4 && this.status == 200) {
										
								document.getElementById('table1').innerHTML = this.responseText;//MSK-000132
								cTablePage(page);//MSK-000133	
								Delete_alert(myArray[0]);//MSK-000134
							}
								
						};
						
						xhttp1.open("GET", "show_exam_routing_table.php" , true);												
  						xhttp1.send();//MSK-000131-End Ajax
				
				}
		
				//if(myAray1[0]==2){//MSK-000137
			
					//$("#deleteConfirm").modal('hide');
					//Delete_alert(myArray[0]);//MSK-000138
				
				//}


    	}
			
  	};	
	//xhttp2.open("GET", "timetable_update_form.php?subject="+myArray1[2] + "&grade="+grade, true);	
    xhttp.open("GET", "../model/delete_exam_routing.php?grade="+grade + "&exam="+exam + "&subject="+subject + "&page="+currentPage + "&do="+do1, true);												
  	xhttp.send();//MSK-000127-Ajax End
	 			   		
});

function cTablePage(page){
//MSK-000135	
	var currentPage1 = (page-1)*10;
	alert(currentPage1);
	$(function(){
		$("#example1").DataTable({
			"displayStart": currentPage1,    
			"bDestroy": true       
   		});
						
	});
					  
	window.scrollTo(0,document.body.scrollHeight);
	
};	

function Delete_alert(msg){
//MSK-000136	
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