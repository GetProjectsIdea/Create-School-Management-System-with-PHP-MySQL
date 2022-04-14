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

.msk-modal-content {
   position: absolute;
   left: 125px; 
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
        	Attendance
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Attendance</a></li>
    	</ol>
	</section>

	<!-- Main content -->
	<section class="content">
    	<div class="row">
        	<!-- left column -->
            <div class="col-md-5">
            	<!-- general form elements -->
              	<div class="box box-primary">
                	<div class="box-header with-border">
                  		<h3 class="box-title">Add Attendance </h3>
                	</div><!-- /.box-header -->
                    <form role="form" action="../index.php" method="post" id="form1" >
                  		<div class="box-body">
                    		<div class="form-group" id="divIndex">
                      			<label for="">Index Number</label>
                      			<input type="text" class="form-control" id="index_number" placeholder="Enter index number" name="index_number" autocomplete="off" onChange="this.value">
                    		</div>
                  		</div><!-- /.box-body -->
                  		<div class="box-footer">
                        	<input type="hidden" name="do" value="add_attendance">
                    		<button type="submit" class="btn btn-primary" id="btnSubmit" >Submit</button>
                  		</div>
                     </form>   
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- End of form section -->
    
<script>

$("form").submit(function (e) {
//MSK-000098-form submit	

	var index = $('#index_number').val();	

	if(index == ''){
		//MSK-00099-name
		$("#btnSubmit").attr("disabled", true);
		$('#divIndex').addClass('has-error has-feedback');	
		$('#divIndex').append('<span id="spanIndex" class="glyphicon glyphicon-remove form-control-feedback set-width-tooltip" data-toggle="tooltip"    title="The index number is required" ></span>');	
			
		$("#index_number").keydown(function() {
			//MSK-00100-name
			$("#btnSubmit").attr("disabled", false);	
			$('#divIndex').removeClass('has-error has-feedback');
			$('#spanIndex').remove();
			
		});	
		
	}else{
		
	}

	if(index == ''){
		//MSK-000098- form validation failed
		$("#btnSubmit").attr("disabled", true);
		e.preventDefault();
		return false;
			
	}else{
		
		$("#btnSubmit").attr("disabled", false);
		
	}

});

function duePayment(index){

	var do1 = "add_payment_notifications";

	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
					
				var myArray = eval(xhttp.responseText);
				var msg = myArray[0];
											
			}
				
		};	
			
		xhttp.open("GET", "../model/add_payment_notifications.php?index="+index +"&do="+do1, true);												
		xhttp.send();//MSK-00105-Ajax End
	
};

</script>

</div><!-- /.content-wrapper -->  

<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert_student_atd")){
	
$msg=$_GET["msg"];
$monthly_fee=$_GET["monthly_fee"];
$index=$_GET["index"];

	if($monthly_fee==1){
		
		echo '<script>','duePayment('.$index.');','</script>';
		
	}
	

	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#insert_Success');
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
		echo"
			<script>
			
			var myModal = $('#attendance_Duplicated');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}
	
	
}


if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert_teacher_atd")){
	
$msg=$_GET["msg"];

	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#insert_Success');
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
		echo"
			<script>
			
			var myModal = $('#attendance_Duplicated');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}
	
}

if(isset($_GET["do"])&&($_GET["do"]=="wrong_index")){
	
$msg=$_GET["msg"];

	if($msg==4){
		
		echo"
			<script>
			
			var myModal = $('#wrong_Index');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}

}
?>

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

</script>
                           
<?php include_once('footer.php');?>