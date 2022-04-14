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
        	Subject
            <small>Routing</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subject Routing</a></li>
        </ol>
	</section>

<!-- table for view all records -->
       
	<!-- Main content -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
            	<div class="box">
                	<div class="box-header">
                 		<a href="#modalInsertform" onClick="" class="btn btn-success btn-sm pull-right" data-id="<?php echo $row["id"]; ?>" data-toggle="modal">Add <span class="glyphicon glyphicon-plus"></span></a><!-- MSK-00094-->
                  		<h3 class="box-title">Subject Routing</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!-- MSK-00093-->
                		<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Grade</th>
                                <th class="col-md-1">Subject</th>
                                <th class="col-md-4">Teacher</th>
                                <th class="col-md-1">Fee($)</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                        	<tbody>
<?php
include_once('../controller/config.php');
$sql="select subject_routing.id as sr_id,subject_routing.fee as s_fee,grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
	  from subject_routing
      inner join grade
      on subject_routing.grade_id=grade.id 
      inner join subject
      on subject_routing.subject_id=subject.id 
      inner join teacher
      on subject_routing.teacher_id=teacher.id";
  
$result=mysqli_query($conn,$sql);
$count = 0;
$current_date_number=date("d");

if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		$sr_id=$row['sr_id'];
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['g_name']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['s_name']; ?></td>
               <!--MSK-000115-td3--><td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['t_name']; ?></td>
               <!--MSK-000115-td4--><td id="td4_<?php echo $count; ?>"><?php echo $row['s_fee']; ?></td>
                                    <td id="action_<?php echo $count; ?>"> 
                                    
<?php
$sql1="SELECT * FROM student_subject WHERE sr_id='$sr_id'";

$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0) {
	
	echo '<a href="#" id="edit1_sfee_'.$count.'" onClick="editSubjectFee(this)" class="btn btn-warning btn-xs cant-edit" data-id="'.$sr_id.','.$count.','.$row["s_fee"].'" >Edit Fee</a>';

}else{
	
	echo '<a href="#modalUpdateform" id="edit_sfee_'.$count.'" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$sr_id.','.$count.'" data-toggle="modal">Edit</a>';  
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs" id="delete_sfee_'.$count.'" data-id="'.$sr_id.'">Delete</a>'; 
                                            	
}

if($current_date_number > 5){
	//disabled
	echo "<script>$('.cant-edit').addClass('disabled');</script>";
}

?>                                    

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
           		<div class="col-md-3 ">
            		<div class="panel panel-primary">
        				<div class="panel-heading">               
        					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          					<h3 class="panel-title">Add Subject Routing</h3>
   						</div>
            			 <form role="form" action="../index.php" method="post">
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
                                
                                <div class="form-group" id="divTeacher">
                					<label for="" >Teacher</label>
        							<select class="form-control"  id="teacher" name="teacher_id">			
     									<option>Select Teacher</option>
<?php
//MSK-00098
include_once('../controller/config.php');
$sql="SELECT * FROM teacher";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
?> 
                    				
     									<option value="<?php echo $row["id"]; ?>"><?php echo $row['i_name']; ?></option>
<?php }} ?>	          
									</select>
        						</div> 
                                
                                <div class="form-group" id="divFee">
                					<label for="" >Fee($)</label>
        							<input type="text" class="form-control" id="fee" name="fee"  placeholder="Enter subject fee" autocomplete="off"/>
        						</div>  
               
            				</div><!--/.modal body-->
            
            				<div class="panel-footer bg-blue-active">
            					<input type="hidden" name="do" value="add_subject_routing"  />
                    			<button type="submit" class="btn btn-info " id="btnSubmit" style="width:100%;">Submit</button>
             				</div>
             			</form>       
      				</div><!--/.panel-->
         		</div><!--/.col-md-3 --> 
            </div><!--/.row-->      
        </div><!-- /.modal-content -->  		 
  	</div><!-- /.modal-dialog -->   
</div><!--/.modal-modalInsertform -->
   
 <script> 

$("form").submit(function (e) {
	
	var grade = $('#grade').val();
	var subject = $('#subject').val();
	var teacher = $('#teacher').val();	
	var fee = $('#fee').val();	

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
	
	if(teacher == 'Select Teacher'){
		//MSK-00100-teacher 
		$("#btnSubmit").attr("disabled", true);
		$('#divTeacher').addClass('has-error has-feedback');
		$('#divTeacher').append('<span id="spanTeacher" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The teacher is required" ></span>');	
	
		$("#teacher").change(function() {
			//MSK-00101-teacher 
  			$("#btnSubmit").attr("disabled", false);	
			$('#divTeacher').removeClass('has-error has-feedback');
			$('#spanTeacher').remove();
		
		});

	}else{
	
	}

	if(fee == ''){
		//MSK-00100-fee
		$("#btnSubmit").attr("disabled", true);
		$('#divFee').addClass('has-error has-feedback');
		$('#divFee').append('<span id="spanFee" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The fee is required" ></span>');	
	
		$("#fee").keydown(function() {
			//MSK-00101-fee       
  			$("#btnSubmit").attr("disabled", false);	
			$('#divFee').removeClass('has-error has-feedback');
			$('#spanFee').remove();
		
		});

	}else{
	
	}

	if(grade == 'Select Grade' || subject == 'Select Subject' || teacher == 'Select Teacher' || fee == '' ){
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
               
<!-- //MSK-00103 Modal-modalUpdateform-->  
	<div class="modal msk-fade" id="modalUpdateform" tabindex="-1" role="dialog" aria-labelledby="modalUpdateform1" aria-hidden="true">  
  		<div class="modal-dialog ">
    		<div class="container modal-content1 "><!--modal-content --> 
                <div class="row">	
                    <div class="col-md-3 ">
                        <div class="panel">
                            <div class="panel-heading bg-orange">               
        						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          						<h3 class="panel-title">Edit Subject Routing</h3>
   							</div>
                            <div class="panel-body"> <!-- Start of the modal body--> 
                                <div class="form-group" id="divGrade1">
                                    <label for="" >Grade</label>
                                    <select class="form-control"  id="grade1" name="grade_id">			
                                            
    <?php
    include_once('../controller/config.php');
    $sql="SELECT * FROM grade";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
    ?> 
                                        <option value="<?php echo $row["name"]; ?>"><?php echo $row['name']; ?></option>
    <?php }} ?>	           
                                    </select>
                                </div>
                                <div class="form-group" id="divSubject1">
                                    <label for="" >Subject</label>
                                    <select class="form-control"  id="subject1" name="subject_id">			
    <?php
    include_once('../controller/config.php');
    $sql="SELECT * FROM subject";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
    ?> 
                                        <option value="<?php echo $row["name"]; ?>"><?php echo $row['name']; ?></option>
    <?php }} ?> 	           
                                    </select>
                                </div> 
                                <div class="form-group" id="divTeacher1">
                                    <label for="" >Teacher</label>
                                    <select class="form-control"  id="teacher1" name="teacher_id">			
                                        <option>Select Teacher</option>
    <?php
    include_once('../controller/config.php');
    $sql="SELECT * FROM teacher";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
    ?> 
                                        <option value="<?php echo $row["i_name"]; ?>"><?php echo $row['i_name']; ?></option>
    <?php }} ?>	          
                                    </select>
                                </div> 
                                <div class="form-group" id="divFeeUpdate">
                                    <label for="" >Fee($)</label>
                                    <input type="text" class="form-control" id="fee1" name="fee"  placeholder="Enter subject fee" autocomplete="off"/>
                                </div>  
                            </div><!--/.modal body-->
                            <div class="panel-footer bg-gray-light">
                            	<input type="hidden" id="count1" value="">
                                <button type="button" class="btn btn-info" id="btnSubmit1" onClick="UpdateSubjectFee(this)" style="width:100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button><!--MSK-000108-->
                            </div><!--/.panel-footer-->
                        </div><!--/.panel-->
                    </div><!--/.col-md-3 --> 
                </div><!--/.row-->      
            </div><!-- /.modal-content -->  		 
        </div><!-- /.modal-dialog -->   
    </div><!--/.Modal-Add form -->

<script>
function showModal(Updateform){
//MSK-00104
	
	var myArray = $(Updateform).data("id").split(',');
	
	var Id = myArray[0]; 
	var count = myArray[1]; 
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				//MSK-00107 
				var myArray1 = eval( xhttp.responseText );
						
				document.getElementById("btnSubmit1").value =myArray1[0];
				document.getElementById("grade1").value =myArray1[1];
				document.getElementById("subject1").value =myArray1[2];
				document.getElementById("teacher1").value =myArray1[3];
				document.getElementById("fee1").value =myArray1[4];
				document.getElementById("count1").value=count;
					
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/get_subject_routing.php?id=" + Id , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};
  
function UpdateSubjectFee(){
	
	var Id1 = document.getElementById('btnSubmit1').value;
	var grade = document.getElementById("grade1").value;
	var subject = document.getElementById("subject1").value;	
	var teacher = document.getElementById("teacher1").value;
	var fee = document.getElementById("fee1").value;
	var count = document.getElementById("count1").value;
	
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
						document.getElementById("td4_"+count ).innerHTML =myArray2[3];
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

function editSubjectFee(sFee){
	
	var myArray = $(sFee).data("id").split(',');
	
	var id = myArray[0];
	var count = myArray[1];

	var fee= document.getElementById('td4_'+count).innerHTML;
	
	var do1="show_subject_fee_text";
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
							
				document.getElementById('td4_'+count).innerHTML = this.responseText;//MSK-000137
						
				$('#edit_sfee_'+count).hide();
				$('#edit1_sfee_'+count).hide();
				$('#delete_sfee_'+count).hide();
				
				$('#action_'+count).append('<a id="update_sfee_'+count+'" onclick="updateSubjectFee(this)" data-id="'+id+','+count+'" class="glyphicon glyphicon-ok btn btn-success btn-xs" ></a>');			
			}
				
		};	
							
    	xhttp.open("GET", "subject_fee_text.php?id="+id + "&count="+count +"&fee="+fee +"&do="+do1, true);												
  		xhttp.send();//MSK-00135-Ajax End
	
	
};


function updateSubjectFee(updateSFee){
	
	var myArray = $(updateSFee).data("id").split(',');
	
	var id = myArray[0];
	var count = myArray[1];
	
	var fee = $('#sFeeText_'+count).val();
	var do1="update_subject_fee";

	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg=myArray[0];
				
				if(msg == 1){
					
					$('#update_sfee_'+count).remove();
					
					$('#sFeeText_'+count).remove();
					
					$('#td4_'+count).html(fee);
					
					$('#edit_sfee_'+count).show();
					$('#edit1_sfee_'+count).show();
					$('#delete_sfee_'+count).show();
					
					Update_alert(msg);
					
				}
				
				if(msg == 2){
					
					Update_alert(msg);
					
				}
				
							
			}
				
		};	
							
    	xhttp.open("GET", "../model/update_subject_fee.php?id="+id +"&fee="+fee +"&do="+do1, true);												
  		xhttp.send();//MSK-00135-Ajax End
	
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
     		
    var id = $('#deleteConfirm').data('id1');	
	var do1 = "delete_record";	
	var table_name1= "subject_routing";//give data table name
		
	var info = $('#example1').DataTable().page.info();
	var currentPage= (info.page + 1);
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
					
				if(myArray[0]==1){//MSK-000130
				
					$("#deleteConfirm").modal('hide');	        		
					var page = myArray[1];
				
					var xhttp1 = new XMLHttpRequest();//MSK-000131-Start Ajax  
						xhttp1.onreadystatechange = function() {		
				
							if (this.readyState == 4 && this.status == 200) {
										
								document.getElementById('table1').innerHTML = this.responseText;//MSK-000132
								cTablePage(page);//MSK-000133	
								Delete_alert(myArray[0]);//MSK-000134
							}
								
						};
						xhttp1.open("GET", "show_subject_routing_table.php" , true);												
  						xhttp1.send();//MSK-000131-End Ajax
				
				}
		
				if(myArray[0]==2){//MSK-000137
			
					$("#deleteConfirm").modal('hide');
					Delete_alert(myArray[0]);//MSK-000138
				
				}


    	}
			
  	};	
	
    xhttp.open("GET", "../model/delete_record.php?id=" + id + "&do="+do1 + "&table_name="+table_name1 + "&page="+currentPage , true);												
  	xhttp.send();//MSK-000127-Ajax End
	 			   		
});

function cTablePage(page){
//MSK-000135	
	var currentPage1 = (page-1)*10;
	
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