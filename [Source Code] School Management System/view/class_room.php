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
.form-control-feedback {
   pointer-events: auto;
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}

.msk-fade {  
      
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

@media only screen and (max-width: 500px) {
	
.content {
	width:100% !important;
}

#example1{
	width:100% !important;
}
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Classroom
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classroom</a></li>
        </ol>
	</section>

    <!-- Main content -->
    <section class="content">
    	<div class="row"><!-- left column -->
            <div class="col-md-6"><!-- general form elements -->
              	<div class="box box-primary">
                	<div class="box-header with-border">
                  		<h3 class="box-title">Add Classroom</h3>
                	</div><!-- /.box-header -->
                	<!-- //MSK-00097 form start -->
                	<form role="form" action="../index.php" method="post">             
						<div class="box-body">
                			<div class="form-group" id="divName">
                    			<label for="">Name</label>
                      			<input type="text" class="form-control" id="name" placeholder="Enter classroom name" name="name" autocomplete="off">                    
                    		</div>
                    		<div class="form-group" id="divStudentCount">
                      			<label for="">Student Count</label>
                      			<input type="text" class="form-control" id="student_count" placeholder="Enter student count" name="student_count"  		autocomplete="off">
                    		</div>
                		</div><!-- /.box-body -->
                		<div class="box-footer">
                  			<input type="hidden" name="do" value="add_classroom" />
                    		<button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                 		</div>
                	</form>
              	</div><!-- /.box -->
            </div>
		</div>
	</section><!-- End of form section -->
   
<script>

$("form").submit(function (e) {
//MSK-000098-form submit
	
	var name = $('#name').val();	
	var student_count = $('#student_count').val();
	var hall_charge = $('#hall_charge').val();	
	
	if(name == ''){
		//MSK-00099-name 
		$("#btnSubmit").attr("disabled", true);
		$('#divName').addClass('has-error has-feedback');	
		$('#divName').append('<span id="spanName" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The name is required" ></span>');	
				
		$("#name").keydown(function() {
			//MSK-00100-name  
			$("#btnSubmit").attr("disabled", false);	
			$('#divName').removeClass('has-error has-feedback');
			$('#spanName').remove();
			
		});	
		
	}else{
		
	}

	if(student_count == ''){
		//MSK-00099-student_count
		$("#btnSubmit").attr("disabled", true);
		$('#divStudentCount').addClass('has-error has-feedback');
		$('#divStudentCount').append('<span id="spanStudentCount" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The student count is required" ></span>');	
		
		$("#student_count").keydown(function() {
			//MSK-00100-student_count
			$("#btnSubmit").attr("disabled", false);	
			$('#divStudentCount').removeClass('has-error has-feedback');
			$('#spanStudentCount').remove();
			
		});
	
	}else{
		
	}
				 		
	if(name == '' || student_count == ''){
		//MSK-000098- form validation failed
		$("#btnSubmit").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		$("#btnSubmit").attr("disabled", false);
		
	}


});
</script> 
 
   
<!--run Insert alert using PHP $ JS/jQuery  -->          
<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert")){
//MSK-000143-6-PHP-JS-INSERT
	
	$msg=$_GET['msg'];

	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#classroom_Duplicated');
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
    
<!-- table for view all records -->
       
    <!-- Main content -->
    <section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-8">
            	<div class="box">
                	<div class="box-header">
                  		<h3 class="box-title">All Classroom</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive" style="overflow-x:auto;">
                    	<!--MSK-00101-->
                		<table id="example1" class="table table-bordered table-striped">
                    		<thead>
                        		<th>ID</th>
                            	<th>Name</th>
                            	<th>Student Count</th>
                            	<th>Action</th>
                        	</thead>
                        	<tbody>
<?php

include_once('../controller/config.php');
$sql="SELECT * FROM class_room";
$result=mysqli_query($conn,$sql);
$count = 0;
$cant_remove=0;
$cant_remove1=0;
if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){	
	$count++;
	$id=$row['id'];
?>   
                        		<tr>
                            		<td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row['id']; ?>"><?php echo $row['student_count']; ?></td>
                                	<td>  
                                    
<?php
$sql1="SELECT * FROM timetable WHERE classroom_id='$id'";	
   
$result1=mysqli_query($conn,$sql1);

if(mysqli_num_rows($result1) > 0){
	$cant_remove=1;
}else{
	$cant_remove=0;
}

$sql2="SELECT * FROM exam_timetable WHERE classroom_id='$id'";	   
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2) > 0){
	$cant_remove1=1;
}else{
	$cant_remove1=0;
}


if($cant_remove > 0 ||  $cant_remove1 > 0){
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	
}else{
	
	echo '<a href="#modalUpdateform" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="'.$id.'" data-toggle="modal">Edit</a>';
	echo ' <a href="#" class="confirm-delete btn btn-danger btn-xs"  data-id="'.$id.'">Delete</a>';
	
}

?>                                    
  
                               		</td>                                
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>	                
               		</div>
              	</div>
            </div>
		</div>
	</section> <!-- End of table section -->
    
	<!-- //MSK-00103 Modal-Update form -->  
	<div class="modal msk-fade" id="modalUpdateform" tabindex="-1" role="dialog" aria-labelledby="modalUpdateform" aria-hidden="true">  
  		<div class="modal-dialog">
    		<div class="container">
            	<div class="row ">	
           			<div class="col-md-6">
                		<div class="panel">
        					<div class="panel-heading bg-orange">               
        						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          						<h4 class="modal-title custom_align" id="Heading">Edit Classroom</h4>
   							</div>
                            <div class="panel-body"> <!-- Start of modal body--> 
                                <div class="form-group" id="divNameUpdate">
                                    <label for="">Name</label>
                                    <input class="form-control" type="text" id="name1" name="name" autocomplete="off">
                                </div> 
                                <div class="form-group" id="divSCountUpdate">
                                    <label for="">Student Count</label>
                                    <input class="form-control " type="text" id="student_count1" name="student_count" autocomplete="off">
                                </div>
                            </div><!--/.modal body-->
                            <div class="panel-footer bg-gray-light">
                                <input type="hidden" name="id" id="id" value="">
                                <button type="button" onClick="Updateclassroom(this)" id="btnSubmit1" class="btn btn-info" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                            </div><!--/.panel-footer-->  
            			</div><!--/.panel--> 
            		</div><!--/.col-md-6-->
            	</div><!--/.row-->                                    
        	</div><!-- /.modal-content -->  		 
  		</div><!-- /.modal-dialog -->        
	</div><!--/.Modal-Update form --> 
    
<script>
function showModal(Updateform){
//MSK-00104
	
	var Id = $(Updateform).data("id");  
		
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-00107 
				var myArray1 = eval(xhttp.responseText);
				
				document.getElementById("id").value =myArray1[0];
				document.getElementById("name1").value =myArray1[1];
				document.getElementById("student_count1").value =myArray1[2];

    		}
			
  		};	
		
    xhttp.open("GET", "../model/get_classroom.php?id=" + Id , true);												
  	xhttp.send();//MSK-00105-Ajax End
	 
};
  
function Updateclassroom(){
//MSK-000108
	
	var Id1 = document.getElementById('id').value;
	var name1 = document.getElementById('name1').value;
	var student_count1 = document.getElementById('student_count1').value;

	if(name1 == ''){
		//MSK-00109-name
		$("#btnSubmit1").attr("disabled", true);
		$('#divNameUpdate').addClass('has-error has-feedback');	
		$('#divNameUpdate').append('<span id="spanNameUpdate" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The name is required" ></span>');	
			
		$("#name1").keydown(function() {
			//MSK-00110-name 
			$("#btnSubmit1").attr("disabled", false);	
			$('#divNameUpdate').removeClass('has-error has-feedback');
			$('#spanNameUpdate').remove();
			
		});	
	}else{
		
	}

	if(student_count1 == ''){
		//MSK-00109-student_count
		$("#btnSubmit1").attr("disabled", true);
		$('#divSCountUpdate').addClass('has-error has-feedback');
		$('#divSCountUpdate').append('<span id="spanSCountUpdate" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip" title="The student count is required" ></span>');	
		
		$("#student_count1").keydown(function() {
			//MSK-00110-student_count
			$("#btnSubmit1").attr("disabled", false);	
			$('#divSCountUpdate').removeClass('has-error has-feedback');
			$('#spanSCountUpdate').remove();
			
		});
	
	}else{
		
	}
				 		
	if(name1 == '' || student_count1 == '' ){
		//MSK-000098-validation failed
		$("#btnSubmit1").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		
		$("#btnSubmit1").attr("disabled", false);
		var do1 = "update_classroom";	
		
		var xhttp = new XMLHttpRequest();//MSK-00111-Ajax Start  
  			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//MSK-000112
					var myArray2 = eval(xhttp.responseText);
					var msg = myArray2[3];
					
					if(msg==1){//MSK-000113
						
						//MSK-000114
						document.getElementById("td1_"+Id1 ).innerHTML =myArray2[1];
						document.getElementById("td2_"+Id1 ).innerHTML =myArray2[2];
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
			
  			xhttp.open("GET", "../model/update_classroom.php?id=" + Id1 + "&name="+name1 + "&student_count="+student_count1  +  "&do="+do1, true);												
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
		
    	var myModal = $('#classroom_Duplicated');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}
	
};

</script>    

<!-- //MSK-000124 Modal-Delete Confirm Popup -->
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
	var table_name= "class_room";//give data table name
		
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
						
						xhttp1.open("GET", "show_classroom_table.php" , true);												
  						xhttp1.send();//MSK-000131-End Ajax
				
					}
		
					if(myArray[0]==2){//MSK-000137
			
						$("#deleteConfirm").modal('hide');
						Delete_alert(myArray[0]);//MSK-000138
				
					}
    		}
			
  		};	
    xhttp.open("GET", "../model/delete_record.php?id=" + id + "&do="+do1 + "&table_name="+table_name + "&page="+currentPage , true);												
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